<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status  = $request->get('status', 'all');
        $query   = Order::with(['user', 'items.menuItem'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20);

        $counts = [
            'all'             => Order::count(),
            'pending_payment' => Order::where('status', 'pending_payment')->count(),
            'pending'         => Order::where('status', 'pending')->count(),
            'preparing'       => Order::where('status', 'preparing')->count(),
            'on_way'    => Order::where('status', 'on_way')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'status', 'counts'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.menuItem']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,pending,preparing,on_way,delivered',
        ]);

        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        if ($oldStatus !== $request->status) {
            try {
                if ($request->status === 'on_way') {
                    Mail::send('emails.order-shipped', ['order' => $order], function ($message) use ($order) {
                        $message->to($order->user->email)
                                ->subject('¡Tu pedido va en camino! 🛵 - Mr. Sabor');
                    });
                } elseif ($request->status === 'delivered') {
                    Mail::send('emails.order-delivered', ['order' => $order], function ($message) use ($order) {
                        $message->to($order->user->email)
                                ->subject('¡Pedido Entregado! (Factura) 🍔 - Mr. Sabor');
                    });
                }
            } catch (\Exception $e) {
                // Silently ignore mail errors to prevent crashing the status update
            }
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status_label' => $order->fresh()->status_label,
                'status_color' => $order->fresh()->status_color,
                'status_icon'  => $order->fresh()->status_icon,
            ]);
        }

        return back()->with('success', 'Estado actualizado a: ' . $order->fresh()->status_label);
    }

    public function getPendingOrdersCount()
    {
        // Contamos los pagos o los pendientes
        $count = Order::whereIn('status', ['pending', 'pending_payment'])->count();
        $latest = Order::latest()->first();
        return response()->json([
            'count' => $count,
            'latest_id' => $latest ? $latest->id : null
        ]);
    }
}
