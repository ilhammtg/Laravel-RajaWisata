<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'favoritable_id' => 'required|integer',
            'favoritable_type' => 'required|string',
        ]);

        $userId = Auth::id();
        $favoritableId = $request->favoritable_id;
        $favoritableType = $request->favoritable_type;

        // Ensure the type is fully qualified if not already
        if (!str_contains($favoritableType, 'App\\Models\\')) {
            $favoritableType = 'App\\Models\\' . $favoritableType;
        }

        $favorite = Favorite::where('user_id', $userId)
            ->where('favoritable_id', $favoritableId)
            ->where('favoritable_type', $favoritableType)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back();
        }

        Favorite::create([
            'user_id' => $userId,
            'favoritable_id' => $favoritableId,
            'favoritable_type' => $favoritableType,
        ]);

        return back();
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with('favoritable')->get();
        return response()->json($favorites);
    }
}
