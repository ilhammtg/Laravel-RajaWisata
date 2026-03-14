<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_id' => 'required|integer',
            'reviewable_type' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $reviewableType = $request->reviewable_type;
        if (!str_contains($reviewableType, 'App\\Models\\')) {
            $reviewableType = 'App\\Models\\' . $reviewableType;
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'reviewable_id' => $request->reviewable_id,
            'reviewable_type' => $reviewableType,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true, // Auto-approve for now
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
