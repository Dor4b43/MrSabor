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
            'address_id'       => 'required|exists:addresses,id',
            'notes'            => 'nullable|string|max:500',
        ]);

        $total = 0;
        $orderItemsData = [];

        foreach ($request->items as $item) {
            $menuItem = MenuItem::findOrFail($item['id']);
            if (!$menuItem->is_available) continue;

            $qty = (int) $item['quantity'];
            $price = (float) $menuItem->price;
            $total += $price * $qty;

            $orderItemsData[] = [
                'menu_item_id' => $menuItem->id,
                'quantity'     => $qty,
                'unit_price'   => $price,
            ];
        }

        if (empty($orderItemsData)) {
            return back()->with('error', 'No hay items disponibles en tu pedido.');
        }

        DB::transaction(function () use ($request, $total, $orderItemsData) {
            $deliveryFee = Setting::where('key', 'delivery_fee')->value('value') ?? 0;
            
            $order = Order::create([
                'user_id'      => Auth::id(),
                'status'       => 'pending',
                'total'        => $total,
                'delivery_fee' => $deliveryFee,
                'address_id'   => $request->address_id,
                'notes'        => $request->notes,
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
