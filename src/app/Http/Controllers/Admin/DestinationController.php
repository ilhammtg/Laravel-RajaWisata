<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Culinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DestinationController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Destinations/Index', [
            'destinations' => Destination::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Destinations/Form', [
            'hotels' => Hotel::where('is_active', true)->orderBy('name')->get(['id', 'name']),
            'culinaries' => Culinary::where('is_active', true)->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'is_hero' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destinations', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('destinations/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;
        $hotelIds = $request->input('hotel_ids', []);
        $culinaryIds = $request->input('culinary_ids', []);

        $destination = Destination::create($validated);
        $destination->hotels()->sync($hotelIds);
        $destination->culinaries()->sync($culinaryIds);

        Cache::forget('landing_page_data');

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destination $destination)
    {
        return Inertia::render('Admin/Destinations/Form', [
            'destination' => $destination->load(['hotels:id', 'culinaries:id']),
            'hotels' => Hotel::where('is_active', true)->orderBy('name')->get(['id', 'name']),
            'culinaries' => Culinary::where('is_active', true)->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'is_hero' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it was a local file
            if ($destination->image_url && str_contains($destination->image_url, '/storage/destinations/')) {
                $oldPath = str_replace('/storage/', '', $destination->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = $request->file('image')->store('destinations', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('destinations/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;
        $hotelIds = $request->input('hotel_ids', []);
        $culinaryIds = $request->input('culinary_ids', []);

        $destination->update($validated);
        $destination->hotels()->sync($hotelIds);
        $destination->culinaries()->sync($culinaryIds);

        Cache::forget('landing_page_data');

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        Cache::forget('landing_page_data');

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}
