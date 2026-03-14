<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CulinaryController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Culinaries/Index', [
            'culinaries' => Culinary::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Culinaries/Form');
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
            'rating' => 'nullable|numeric|min:0|max:5',
            'price_range' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('culinaries', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('culinaries/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        Culinary::create($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.culinaries.index')->with('success', 'Data Kuliner berhasil ditambahkan.');
    }

    public function edit(Culinary $culinary)
    {
        return Inertia::render('Admin/Culinaries/Form', [
            'culinary' => $culinary
        ]);
    }

    public function update(Request $request, Culinary $culinary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price_range' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it was a local file
            if ($culinary->image_url && str_contains($culinary->image_url, '/storage/culinaries/')) {
                $oldPath = str_replace('/storage/', '', $culinary->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = $request->file('image')->store('culinaries', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('culinaries/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        $culinary->update($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.culinaries.index')->with('success', 'Data Kuliner berhasil diperbarui.');
    }

    public function destroy(Culinary $culinary)
    {
        $culinary->delete();
        Cache::forget('landing_page_data');

        return redirect()->route('admin.culinaries.index')->with('success', 'Data Kuliner berhasil dihapus.');
    }
}
