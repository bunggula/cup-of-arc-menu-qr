<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FeedbackController;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\FaqController;

Route::get('/', function () { return view('admin.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Protected Route (Kailangan naka-login para makita ito)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
});
Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware('auth');
Route::post('/admin/categories', [CategoryController::class, 'store'])->middleware('auth');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update']);
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->middleware('auth');
// Items Management
Route::get('/admin/categories/{category}/items', [CategoryController::class, 'showItems']);
Route::post('/admin/categories/{category}/items', [CategoryController::class, 'storeItem']);
Route::put('/admin/items/{item}', [CategoryController::class, 'updateItem']);
Route::delete('/admin/items/{item}', [CategoryController::class, 'destroyItem']);
// routes/web.php
Route::patch('/admin/items/{item}/toggle-status', [CategoryController::class, 'toggleStatus']);
Route::get('/admin/qrcodes', [QrCodeController::class, 'index'])->name('admin.qrcodes');
Route::get('/admin/qrcodes/print', function () {
    return view('admin.qr-print');
})->middleware('auth');
//customer
Route::get('/menu', [MenuController::class, 'index']);
//feedbacl
Route::post('/feedback', function (Request $request) {
    // Siguraduhin na may laman ang message
    $request->validate([
        'message' => 'required'
    ]);

    // I-save sa database
    Feedback::create([
        'order_item' => $request->order_item,
        'message' => $request->message
    ]);

    return back()->with('success', 'Salamat sa iyong feedback!');
});
Route::get('/admin/feedbacks', [FeedbackController::class, 'adminIndex'])->middleware('auth');
//faqs
Route::get('/admin/faqs', [FaqController::class, 'index'])->middleware('auth');
Route::post('/admin/faqs', [FaqController::class, 'store'])->middleware('auth');
Route::put('/admin/faqs/{faq}', [FaqController::class, 'update'])->middleware('auth');
Route::delete('/admin/faqs/{faq}', [FaqController::class, 'destroy'])->middleware('auth');