<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Mas malinis kung i-import natin sa taas
use App\Models\Faq;      // I-import din ang Faq model

class MenuController extends Controller
{
    public function index() {
        // Kunin lahat ng categories kasama ang kanilang items na available lang
        $categories = Category::with(['items' => function($query) {
            $query->where('is_available', true);
        }])->get();

        // Idagdag mo itong line na ito:
        $faqs = Faq::orderBy('order')->get(); 
    
        // Isama ang 'faqs' sa compact
        return view('menu', compact('categories', 'faqs'));
    }
}