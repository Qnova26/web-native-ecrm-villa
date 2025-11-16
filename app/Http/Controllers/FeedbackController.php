<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showForm()
    {
        return view('feedback');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $feedback = [
            'id' => time(),
            'name' => $validated['name'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'approved' => false,
            'created_at' => now()->toDateTimeString(),
        ];
        $file = storage_path('app/data/feedback.json');
        $feedbacks = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $feedbacks[] = $feedback;
        file_put_contents($file, json_encode($feedbacks, JSON_PRETTY_PRINT));

        return redirect()->route('feedback.form')->with('success', 'Terima kasih atas feedback Anda!');
    }
} 