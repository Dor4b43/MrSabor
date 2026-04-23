<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('sort_order')->orderBy('id')->paginate(20);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function quickCreate()
    {
        $menuItems = MenuItem::where('is_available', true)->orderBy('name')->get();
        return view('admin.promotions.quick-create', compact('menuItems'));
    }

    public function quickStore(Request $request)
    {
        $data = $request->validate([
            'promo_name'    => 'required|string|max:120',
            'menu_item_id'  => 'required|exists:menu_items,id',
            'discount_type' => 'required|in:percent,fixed,2x1,free_delivery',
            'discount_value'=> 'nullable|numeric|min:0',
            'duration'      => 'required|in:today,weekend,limited,permanent',
        ]);

        $item = MenuItem::findOrFail($data['menu_item_id']);

        // Badge
        $badge = match($data['discount_type']) {
            'percent'       => ($data['discount_value'] ?? 0) . '% OFF',
            'fixed'         => '- $' . number_format($data['discount_value'] ?? 0, 0) . ' OFF',
            '2x1'           => '2x1',
            'free_delivery' => 'Envío gratis',
        };

        // Subtitle / duración
        $subtitle = match($data['duration']) {
            'today'     => '🔥 Solo por hoy',
            'weekend'   => '📅 Solo este fin de semana',
            'limited'   => '⏳ Por tiempo limitado',
            'permanent' => null,
        };

        Promotion::create([
            'title'      => $data['promo_name'],
            'subtitle'   => $subtitle,
            'description'=> $item->description,
            'badge_text' => $badge,
            'image_path' => $item->image_path,
            'is_active'  => true,
            'sort_order' => 0,
        ]);

        return redirect()->route('admin.promotions.index')
            ->with('success', '¡Promoción rápida creada exitosamente desde "' . $item->name . '"!');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:120',
            'subtitle'    => 'nullable|string|max:120',
            'description' => 'nullable|string|max:500',
            'badge_text'  => 'nullable|string|max:30',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['image_path'] = null;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('promotions', 'public');
        }

        unset($data['image']);
        Promotion::create($data);

        return redirect()->route('admin.promotions.index')
            ->with('success', '¡Promoción creada exitosamente!');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:120',
            'subtitle'    => 'nullable|string|max:120',
            'description' => 'nullable|string|max:500',
            'badge_text'  => 'nullable|string|max:30',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($promotion->image_path) {
                Storage::disk('public')->delete($promotion->image_path);
            }
            $data['image_path'] = $request->file('image')->store('promotions', 'public');
        }

        unset($data['image']);
        $promotion->update($data);

        return redirect()->route('admin.promotions.index')
            ->with('success', '¡Promoción actualizada!');
    }

    public function destroy(Promotion $promotion)
    {
        if ($promotion->image_path) {
            Storage::disk('public')->delete($promotion->image_path);
        }
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promoción eliminada.');
    }
}
