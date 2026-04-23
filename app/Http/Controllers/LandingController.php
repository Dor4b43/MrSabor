<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Promotion;

class LandingController extends Controller
{
    public function index()
    {
        $menuItems  = MenuItem::where('is_available', true)
            ->orderBy('category')->orderBy('name')
            ->get()->groupBy('category');

        $promotions = Promotion::active()->get();

        return view('welcome', compact('menuItems', 'promotions'));
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
}

