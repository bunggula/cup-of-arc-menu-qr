<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function adminIndex()
    {
        // Kukunin lahat ng feedback, pinakabago sa taas
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedbacks', compact('feedbacks'));
    }

}
