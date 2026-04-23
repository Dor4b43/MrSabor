<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Setting;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('menuCategory')
            ->where('is_available', true)
            ->whereNotNull('category_id')
            ->get()
            ->groupBy(function ($item) {
                return $item->menuCategory ? $item->menuCategory->name : 'Otros';
            });

        $myOrders = Order::where('user_id', Auth::id())
            ->with('items.menuItem')
            ->latest()
            ->take(3)
            ->get();

        $addresses = Auth::user()->addresses ?? [];
        if (is_array($addresses) && empty($addresses)) {
             $addresses = Address::where('user_id', Auth::id())->get();
        } elseif (method_exists(Auth::user(), 'addresses')) {
             $addresses = Auth::user()->addresses;
        } else {
             $addresses = Address::where('user_id', Auth::id())->get();
        }

        $deliveryFee = Setting::where('key', 'delivery_fee')->value('value') ?? 0;

        return view('customer.dashboard', compact('menuItems', 'myOrders', 'addresses', 'deliveryFee'));
    }
}
