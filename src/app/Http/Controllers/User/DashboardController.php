<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return Inertia::render('User/Dashboard', [
            'favorites' => $user->favorites()->with('favoritable')->get(),
            'reviews' => $user->reviews()->with('reviewable')->get(),
        ]);
    }
}
