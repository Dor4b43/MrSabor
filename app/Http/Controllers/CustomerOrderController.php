<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Setting;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.menuItem')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'            => 'required|array|min:1',
            'items.*.id'       => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:20',
            'address_id'       => 'nullable|exists:addresses,id',
            'new_address'      => 'nullable|string|max:255',
            'notes'            => 'nullable|string|max:500',
            'payment_method'   => 'required|in:cash,transfer',
            'payment_receipt'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order_type'       => 'required|in:delivery,pickup',
        ]);

        $total = 0;
        $orderItemsData = [];

        foreach ($request->items as $item) {
            $menuItem = MenuItem::findOrFail($item['id']);
            if (!$menuItem->is_available) continue;

            $qty = (int) $item['quantity'];
            $price = (float) $menuItem->price;
            
            $customizations = null;
            if (!empty($item['customizations'])) {
                $customizations = json_decode($item['customizations'], true);
                if (isset($customizations['extras']) && is_array($customizations['extras'])) {
                    foreach ($customizations['extras'] as $extra) {
                        if (isset($extra['price'])) {
                            $price += (float) $extra['price'];
                        }
                    }
                }
            }

            $total += $price * $qty;

            $orderItemsData[] = [
                'menu_item_id'   => $menuItem->id,
                'quantity'       => $qty,
                'unit_price'     => $price,
                'customizations' => $customizations,
            ];
        }

        if (empty($orderItemsData)) {
            return back()->with('error', 'No hay items disponibles en tu pedido.');
        }

        $receiptPath = null;
        if ($request->payment_method === 'transfer' && $request->hasFile('payment_receipt')) {
            $receiptPath = $request->file('payment_receipt')->store('receipts', 'public');
        } elseif ($request->payment_method === 'transfer') {
            return back()->with('error', 'Debes adjuntar el comprobante de transferencia.');
        }

        DB::transaction(function () use ($request, $total, $orderItemsData, $receiptPath) {
            $addressId = $request->address_id;
            $deliveryFee = 0;
            $orderType = $request->order_type;

            if ($orderType === 'delivery') {
                // Crear nueva dirección al vuelo si no hay address_id
                if (!$addressId && $request->filled('new_address')) {
                    $newAddr = \App\Models\Address::create([
                        'user_id' => Auth::id(),
                        'address' => $request->new_address,
                        'is_main' => \App\Models\Address::where('user_id', Auth::id())->exists() ? false : true,
                    ]);
                    $addressId = $newAddr->id;
                } elseif (!$addressId) {
                    throw new \Exception('Debes proporcionar una dirección de entrega.');
                }
                $deliveryFee = \App\Models\Setting::where('key', 'delivery_fee')->value('value') ?? 0;
            } else {
                $addressId = null;
            }
            
            $status = $request->payment_method === 'transfer' ? 'pending_payment' : 'pending';

            $order = \App\Models\Order::create([
                'user_id'              => Auth::id(),
                'status'               => $status,
                'total'                => $total,
                'delivery_fee'         => $deliveryFee,
                'address_id'           => $addressId,
                'notes'                => $request->notes,
                'payment_method'       => $request->payment_method,
                'payment_receipt_path' => $receiptPath,
                'order_type'           => $orderType,
            ]);

            foreach ($orderItemsData as $itemData) {
                $order->items()->create($itemData);
            }
        });

        return redirect()->route('orders.index')
            ->with('success', '¡Pedido realizado con éxito! Te avisaremos cuando esté listo. 🔥');
    }

    public function show(Order $order)
    {
        // Solo el dueño del pedido puede verlo
        abort_if($order->user_id !== Auth::id(), 403);
        $order->load('items.menuItem');
        return view('customer.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->status === 'cancelled') {
            return back()->with('error', 'El pedido ya está cancelado.');
        }

        // Regla de negocio: maximo 3 minutos despues de haberlo solicitado
        if ($order->created_at->diffInMinutes(now()) > 3) {
            return back()->with('error', 'No puedes cancelar un pedido después de 3 minutos de haberlo solicitado. Debes recibirlo sí o sí.');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Tu pedido ha sido cancelado exitosamente.');
    }
}
