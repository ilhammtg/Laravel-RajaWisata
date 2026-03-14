<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HotelController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Hotels/Index', [
            'hotels' => Hotel::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Hotels/Form');
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
            'rating' => 'numeric|min:0|max:5',
            'price' => 'numeric|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hotels', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('hotels/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        Hotel::create($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    public function edit(Hotel $hotel)
    {
        return Inertia::render('Admin/Hotels/Form', [
            'hotel' => $hotel
        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'rating' => 'numeric|min:0|max:5',
            'price' => 'numeric|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($hotel->image_url && str_contains($hotel->image_url, '/storage/hotels/')) {
                $oldPath = str_replace('/storage/', '', $hotel->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('hotels', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('hotels/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        $hotel->update($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        Cache::forget('landing_page_data');

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil dihapus.');
    }
}
