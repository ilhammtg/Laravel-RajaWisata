<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\Culinary;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'destinations' => Destination::count(),
                'hotels' => Hotel::count(),
                'events' => Event::count(),
                'culinaries' => Culinary::count(),
            ],
            'recent_destinations' => Destination::latest()->take(5)->get(),
            'recent_culinaries' => Culinary::latest()->take(5)->get(),
        ]);
    }
}
