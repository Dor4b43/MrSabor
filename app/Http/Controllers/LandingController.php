<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Promotion;
use App\Models\Order;
use App\Models\Address;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        $menuItems  = MenuItem::where('is_available', true)
            ->orderBy('category')->orderBy('name')
            ->get()->groupBy('category');

        $promotions = Promotion::active()->get();

        $myOrders = [];
        $addresses = [];
        $deliveryFee = Setting::where('key', 'delivery_fee')->value('value') ?? 0;

        if (Auth::check()) {
            $myOrders = Order::where('user_id', Auth::id())
                ->with('items.menuItem')
                ->latest()
                ->take(3)
                ->get();

            $userAddresses = Auth::user()->addresses ?? [];
            if (is_array($userAddresses) && empty($userAddresses)) {
                $addresses = Address::where('user_id', Auth::id())->get();
            } elseif (method_exists(Auth::user(), 'addresses')) {
                $addresses = Auth::user()->addresses;
            } else {
                $addresses = Address::where('user_id', Auth::id())->get();
            }
        }

        return view('welcome', compact('menuItems', 'promotions', 'myOrders', 'addresses', 'deliveryFee'));
    }

    public function showPromotion(Promotion $promotion)
    {
        abort_if(!$promotion->is_active, 404);

        $menuItems  = MenuItem::where('is_available', true)
            ->orderBy('category')->orderBy('name')
            ->get()->groupBy('category');

        $otherPromos = Promotion::active()
            ->where('id', '!=', $promotion->id)
            ->take(3)->get();

        return view('promotions.show', compact('promotion', 'menuItems', 'otherPromos'));
    }

    public function trackView($id)
    {
        $item = MenuItem::find($id);
        if ($item) {
            $item->increment('views_count');
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}

