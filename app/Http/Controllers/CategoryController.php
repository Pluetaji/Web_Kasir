<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::all();

        return view('daftarkategori', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($validated);

        return redirect()->route('manager.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('manager.kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('manager.kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
