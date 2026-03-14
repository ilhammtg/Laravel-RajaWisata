<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Inertia\Inertia;

class TermsController extends Controller
{
    public function index()
    {
        return Inertia::render('Terms', [
            'terms_content' => Setting::get('terms_content', '# Syarat & Ketentuan\n\nSelamat datang di Raja Wisata. Dengan menggunakan layanan kami, Anda setuju untuk mematuhi syarat dan ketentuan berikut...'),
            'settings' => [
                'footer_about' => Setting::get('footer_about'),
                'footer_address' => Setting::get('footer_address'),
                'footer_phone' => Setting::get('footer_phone'),
                'footer_email' => Setting::get('footer_email'),
                'footer_copyright' => Setting::get('footer_copyright'),
                'social_fb' => Setting::get('social_fb'),
                'social_ig' => Setting::get('social_ig'),
                'social_tw' => Setting::get('social_tw'),
            ]
        ]);
    }
}
