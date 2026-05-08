<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Estado actualizado a: ' . $order->fresh()->status_label);
    }
}
