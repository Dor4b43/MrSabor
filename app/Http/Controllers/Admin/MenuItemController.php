<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{

    public function index()
    {
        $items = MenuItem::latest()->paginate(15);
        return view('admin.menu-items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();
        return view('admin.menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:120',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string|max:500',
            'category_id'  => 'required|exists:categories,id',
            'is_available' => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data['is_available'] = $request->boolean('is_available', true);
        $data['image_path']   = null;

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('menu-items', 'public');
        }

        unset($data['image']);
        MenuItem::create($data);

        return redirect()->route('admin.menu-items.index')
            ->with('success', '¡Producto "' . $data['name'] . '" creado exitosamente!');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::where('status', true)->get();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:120',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string|max:500',
            'category_id'  => 'required|exists:categories,id',
            'is_available' => 'nullable|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data['is_available'] = $request->boolean('is_available', true);

        if ($request->hasFile('image')) {
            if ($menuItem->image_path) {
                Storage::disk('public')->delete($menuItem->image_path);
            }
            $data['image_path'] = $request->file('image')->store('menu-items', 'public');
        }

        unset($data['image']);
        $menuItem->update($data);

        return redirect()->route('admin.menu-items.index')
            ->with('success', '¡Producto actualizado exitosamente!');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image_path) {
            Storage::disk('public')->delete($menuItem->image_path);
        }
        $menuItem->delete();

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Producto eliminado.');
    }
}
