<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\User;

use Illuminate\Support\Facades\DB;

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

        // ── KPIs ──────────────────────────────────────────
        // 1. Producto más vendido
        $mostSold = DB::table('order_items')
            ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('menu_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total_sold')
            ->first();

        // 2. Producto menos vendido
        $leastSold = DB::table('order_items')
            ->select('menu_items.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('menu_items', 'menu_items.id', '=', 'order_items.menu_item_id')
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderBy('total_sold')
            ->first();

        // 3. Producto con más interés (vistas)
        $mostViewed = MenuItem::orderByDesc('views_count')->first();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'mostSold', 'leastSold', 'mostViewed'));
    }
}
