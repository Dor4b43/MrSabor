<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'boolean'
        ]);

        Category::create([
            'name' => $data['name'],
            'status' => $request->boolean('status', true)
        ]);

        return back()->with('success', 'Categoría creada con éxito.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'boolean'
        ]);

        $category->update([
            'name' => $data['name'],
            'status' => $request->boolean('status', true)
        ]);

        return back()->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Categoría eliminada.');
    }
}
