<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\Culinary;
use App\Models\Setting;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        // Cache data for 60 minutes to optimize performance
        $data = Cache::remember('landing_page_data', 3600, function () {
            return [
                'hero_destinations' => Destination::with(['reviews' => function($q) { $q->where('is_approved', true)->with('user'); }])->where('is_active', true)->where('is_hero', true)->orderBy('order')->get(),
                'destinations' => Destination::with(['reviews' => function($q) { $q->where('is_approved', true)->with('user'); }])->where('is_active', true)->orderBy('order')->get(),
                'hotels' => Hotel::with(['reviews' => function($q) { $q->where('is_approved', true)->with('user'); }])->where('is_active', true)->orderBy('order')->get(),
                'culinaries' => Culinary::with(['reviews' => function($q) { $q->where('is_approved', true)->with('user'); }])->where('is_active', true)->orderBy('order')->get(),
                'events' => Event::where('is_active', true)->orderBy('order')->get(),
                'settings' => [
                    'info_title' => Setting::get('info_title', 'Rencanakan Petualangan Anda di Kota Naga'),
                    'info_subtitle' => Setting::get('info_subtitle', 'Informasi Perjalanan'),
                    'info_description' => Setting::get('info_description', 'Aceh Selatan bukan sekadar tujuan wisata, melainkan pengalaman yang merangkum sejarah, kebudayaan lokal, kuliner lezat, dan panorama Samudra Hindia yang luas.'),
                    
                    // Footer Info
                    'footer_about' => Setting::get('footer_about', 'Portal resmi pariwisata Kabupaten Aceh Selatan. Temukan pesona alam, budaya, dan kenikmatan kuliner yang tak terlupakan di Serambi Mekkah.'),
                    'footer_address' => Setting::get('footer_address', 'Dinas Pariwisata Aceh Selatan, Tapaktuan'),
                    'footer_phone' => Setting::get('footer_phone', '+62 812 3456 7890'),
                    'footer_email' => Setting::get('footer_email', 'info@rajawisata-acehselatan.go.id'),
                    'footer_copyright' => Setting::get('footer_copyright', 'Pemerintah Kabupaten Aceh Selatan. Hak Cipta Dilindungi.'),
                    
                    // Social Media
                    'social_fb' => Setting::get('social_fb', '#'),
                    'social_ig' => Setting::get('social_ig', '#'),
                    'social_tw' => Setting::get('social_tw', '#'),

                    // Travel Stats (Dynamic from Database)
                    'stats_destinations' => Destination::where('is_active', true)->count() . '+',
                    'stats_culinary' => Culinary::where('is_active', true)->count() . '+',
                    'stats_events' => Event::where('is_active', true)->count() . '+',
                    'stats_service' => Setting::get('stats_service', '100%'),
                    
                    'info_feature_1_title' => Setting::get('info_feature_1_title', 'Akses Transportasi Mudah'),
                    'info_feature_1_desc' => Setting::get('info_feature_1_desc', 'Tersedia penerbangan ke Bandara Cut Ali, atau nikmati perjalanan darat antar lintas Sumatera dengan pemandangan pesisir yang indah.'),
                    'info_feature_2_title' => Setting::get('info_feature_2_title', 'Pusat Informasi Budaya'),
                    'info_feature_2_desc' => Setting::get('info_feature_2_desc', 'Gali kearifan lokal melalui literatur dan interaksi langsung bersama dinas pariwisata yang tersebar di titik-titik krusial desa wisata.'),
                    'info_button_text' => Setting::get('info_button_text', 'Unduh Panduan Wisata (PDF)'),
                    'info_button_link' => Setting::get('info_button_link', '#'),
                    'info_image_1' => Setting::get('info_image_1', 'https://images.unsplash.com/photo-1549473889-14f410d83298?q=80&w=2670&auto=format&fit=crop'),
                    'info_image_2' => Setting::get('info_image_2', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=2670&auto=format&fit=crop'),
                ]
            ];
        });

        if (Auth::check()) {
            $user = Auth::user();
            $favorites = $user->favorites()->with('favoritable')->get();
            $userFavorites = [
                'destinations' => $favorites->where('favoritable_type', 'App\Models\Destination')->pluck('favoritable_id')->toArray(),
                'hotels' => $favorites->where('favoritable_type', 'App\Models\Hotel')->pluck('favoritable_id')->toArray(),
                'culinaries' => $favorites->where('favoritable_type', 'App\Models\Culinary')->pluck('favoritable_id')->toArray(),
                'list' => $favorites,
            ];
            $userReviews = $user->reviews()->with('reviewable')->latest()->take(3)->get();
        } else {
            $userFavorites = [
                'destinations' => [],
                'hotels' => [],
                'culinaries' => [],
                'list' => [],
            ];
            $userReviews = [];
        }

        return Inertia::render('LandingPage', array_merge($data, [
            'user_favorites' => $userFavorites,
            'user_reviews' => $userReviews
        ]));
    }
}
