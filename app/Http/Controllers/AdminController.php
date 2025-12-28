<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $categories = Category::with('items')->get()->groupBy('parent_type');
        
        // Bonus Stats para sa Dashboard cards
        $totalItems = \App\Models\MenuItem::count();
        $bestSellers = \App\Models\MenuItem::where('is_best_seller', true)->count();
    
        return view('admin.dashboard', compact('categories', 'totalItems', 'bestSellers'));
    }
}
