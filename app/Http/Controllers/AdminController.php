<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Kukunin lahat ng categories at ang kani-kanilang items
        $categories = Category::with('items')->get();
        return view('admin.dashboard', compact('categories'));
    }
}
