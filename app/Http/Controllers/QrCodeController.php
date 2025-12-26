<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index()
    {
        // Dito natin ipapakita yung page na may QR code
        return view('admin.qrcodes');
    }
}