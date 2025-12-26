<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\MenuItem;
class CategoryController extends Controller
{
    // Ito yung 'index' method na hinahanap ng error
   public function index()
    {
        // 1. Kunin lahat ng categories sa database
        $categories = Category::latest()->get();

        // 2. Ipasa ang variable sa view gamit ang compact()
        return view('admin.categories', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate(['name' => 'required']);
    
        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name)
        ]);
    
        return back()->with('success', 'Category added!');
    }
    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|unique:categories,name,' . $category->id
    ]);

    $category->update([
        'name' => $request->name,
        'slug' => \Illuminate\Support\Str::slug($request->name)
    ]);

    return back()->with('success', 'Category updated!');
}
public function destroy(Category $category)
{
    $category->delete();
    return back()->with('success', 'Category deleted successfully!');
}
// Ipakita ang Items ng isang category
public function showItems(Category $category)
{
    // Eager load items para mabilis
    $items = $category->items()->latest()->get();
    return view('admin.category-items', compact('category', 'items'));
}

// I-save ang Item sa loob ng category
public function storeItem(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string'
    ]);

    $category->items()->create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'is_best_seller' => $request->has('is_best_seller'),
        'is_available' => true,
    ]);

    return back()->with('success', 'Item added to ' . $category->name . '!');
}
// EDIT/UPDATE ITEM
public function updateItem(Request $request, MenuItem $item)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric'
    ]);

    $item->update([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'is_best_seller' => $request->has('is_best_seller')
    ]);

    return back()->with('success', 'Item updated successfully!');
}

// DELETE ITEM
public function destroyItem(MenuItem $item)
{
    $item->delete();
    return back()->with('success', 'Item removed from menu.');
}
public function toggleStatus(MenuItem $item)
{
    // Babaligtarin lang natin ang current value
    $item->update([
        'is_available' => !$item->is_available
    ]);

    return back()->with('success', $item->name . ' status updated!');
}
}