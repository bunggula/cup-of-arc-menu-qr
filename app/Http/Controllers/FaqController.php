<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request) {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        Faq::create($request->all());
        return back()->with('success', 'FAQ added successfully!');
    }

    public function update(Request $request, Faq $faq) {
        $faq->update($request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]));
        return back()->with('success', 'FAQ updated!');
    }

    public function destroy(Faq $faq) {
        $faq->delete();
        return back()->with('success', 'FAQ deleted!');
    }
}