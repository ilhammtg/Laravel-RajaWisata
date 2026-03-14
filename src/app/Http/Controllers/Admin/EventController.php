<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Events/Index', [
            'events' => Event::orderBy('order')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Events/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('events/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        Event::create($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/Form', [
            'event' => $event
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'location_url' => 'nullable|string',
            'map_iframe' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'image_url' => 'nullable|string',
            'gallery_files.*' => 'nullable|image|max:2048',
            'gallery_urls' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image_url && str_contains($event->image_url, '/storage/events/')) {
                $oldPath = str_replace('/storage/', '', $event->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image')->store('events', 'public');
            $validated['image_url'] = Storage::url($path);
        }

        $gallery = $request->input('gallery_urls', []);
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $file) {
                $path = $file->store('events/gallery', 'public');
                $gallery[] = Storage::url($path);
            }
        }
        $validated['gallery'] = $gallery;

        $event->update($validated);
        Cache::forget('landing_page_data');

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        Cache::forget('landing_page_data');

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
