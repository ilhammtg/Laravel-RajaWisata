<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Settings', [
            'settings' => Setting::getAll()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'info_title' => 'required|string|max:255',
            'info_subtitle' => 'required|string|max:255',
            'info_description' => 'required|string',
            
            'footer_about' => 'required|string',
            'footer_address' => 'required|string|max:255',
            'footer_phone' => 'required|string|max:20',
            'footer_email' => 'required|email|max:255',
            'footer_copyright' => 'required|string|max:255',
            
            'social_fb' => 'nullable|string|max:255',
            'social_ig' => 'nullable|string|max:255',
            'social_tw' => 'nullable|string|max:255',
            
            'stats_destinations' => 'required|string|max:50',
            'stats_culinary' => 'required|string|max:50',
            'stats_events' => 'required|string|max:50',
            'stats_service' => 'required|string|max:50',
            
            'terms_content' => 'required|string',
            
            'info_feature_1_title' => 'required|string|max:255',
            'info_feature_1_desc' => 'required|string',
            'info_feature_2_title' => 'required|string|max:255',
            'info_feature_2_desc' => 'required|string',
            'info_button_text' => 'required|string|max:50',
            'info_button_link' => 'required|string|max:255',
            'info_image_1' => 'required|string|max:255',
            'info_image_2' => 'required|string|max:255',
            
            'guide_content' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        Cache::forget('landing_page_data');

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
