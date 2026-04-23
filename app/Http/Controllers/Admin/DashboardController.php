<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_items'    => MenuItem::count(),
            'total_orders'   => Order::count(),
            'total_clients'  => User::where('role', 'customer')->count(),
            'pending_orders' => Order::whereIn('status', ['pending', 'preparing', 'on_way'])->count(),
        ];

        $recent_orders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
