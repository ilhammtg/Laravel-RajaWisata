<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function download()
    {
        $content = Setting::get('guide_content', '# Panduan Wisata Aceh Selatan\n\nSelamat datang di Kabupaten Aceh Selatan, "Negeri Pala" yang menawan. Panduan ini dirancang untuk membantu Anda menjelajahi keindahan alam, kekayaan budaya, dan kelezatan kuliner kami.');
        
        $data = [
            'title' => 'Panduan Wisata Aceh Selatan',
            'content' => $content,
            'date' => date('d F Y'),
            'footer_address' => Setting::get('footer_address'),
            'footer_phone' => Setting::get('footer_phone'),
            'footer_email' => Setting::get('footer_email'),
        ];

        $pdf = Pdf::loadView('pdf.guide', $data);
        
        return $pdf->download('Panduan_Wisata_Aceh_Selatan.pdf');
    }
}
