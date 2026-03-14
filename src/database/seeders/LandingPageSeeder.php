<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Event;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Destinations (Unique & Detailed)
        Destination::create([
            'name' => 'Tapaktuan Tapa (Jejak Kaki Raksasa)',
            'description' => 'Situs legendaris jejak kaki raksasa di atas karang raksasa.',
            'details' => 'Legenda Tuan Tapa menceritakan tentang perkelahian dua naga dengan seorang pertapa sakti. Jejak kaki raksasa ini menjadi saksi bisu pertarungan tersebut. Pengunjung dapat menikmati deburan ombak Samudra Hindia sambil melihat situs bersejarah ini.',
            'location' => 'Kampung Air, Tapaktuan',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1150806021458!2d97.17813665049616!3d3.2504513104770365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sTapak%20Tuan%20Tapa!5e1!3m2!1sid!2sid!4v1773344473842!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Wisata Sejarah',
            'image_url' => 'https://images.unsplash.com/photo-1555505019-8c3f1c4aba5f?q=80&w=2670&auto=format&fit=crop',
            'is_active' => true,
            'is_hero' => true,
            'order' => 1,
        ]);

        Destination::create([
            'name' => 'Pulau Dua (The Twin Islands)',
            'description' => 'Dua pulau kembar dengan pasir putih dan ekosistem bawah laut yang memukau.',
            'details' => 'Terletak di Bakongan Timur, Pulau Dua menawarkan kejernihan air yang luar biasa untuk snorkeling dan diving. Terumbu karang yang terjaga menjadikannya habitat bagi ribuan ikan hias.',
            'location' => 'Bakongan Timur',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31835.62624508492!2d97.4363234!3d3.0232456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3030ca048842af47%3A0x633d7633633ce0ee!2sPulau%20Dua!5e0!3m2!1sid!2sid!4v1773344473843!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Wisata Bahari',
            'image_url' => 'https://images.unsplash.com/photo-1559825481-12a05cc00344?q=80&w=2626&auto=format&fit=crop',
            'is_active' => true,
            'is_hero' => true,
            'order' => 2,
        ]);

        Destination::create([
            'name' => 'Air Terjun Tingkat Tujuh',
            'description' => 'Air terjun bertingkat tujuh di tengah hutan lindung yang asri.',
            'details' => 'Destinasi ini cocok bagi pecinta trekking. Setiap tingkatan air terjun memiliki kolam alami yang sejuk untuk berenang. Terletak hanya 15 menit dari pusat kota Tapaktuan.',
            'location' => 'Tapaktuan',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31835.62624508492!2d97.18!3d3.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sAir%20Terjun%20Tujuh%20Tingkat!5e0!3m2!1sid!2sid!4v1773344473844!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Wisata Alam',
            'image_url' => 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?q=80&w=2574&auto=format&fit=crop',
            'is_active' => true,
            'is_hero' => false,
            'order' => 3,
        ]);

        Destination::create([
            'name' => 'Puncak Gemilang',
            'description' => 'Menikmati panorama Kota Tapaktuan dan Samudra Hindia dari ketinggian.',
            'details' => 'Puncak Gemilang adalah spot terbaik untuk melihat matahari terbenam. Dari sini, tata kota Tapaktuan yang dihimpit gunung dan laut terlihat jelas.',
            'location' => 'Lhok Rukam',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1!2d97.2!3d3.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sPuncak%20Gemilang!5e0!3m2!1sid!2sid!4v1773344473845!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Wisata Alam',
            'image_url' => 'https://images.unsplash.com/photo-1549473889-14f410d83298?q=80&w=2670&auto=format&fit=crop',
            'is_active' => true,
            'is_hero' => false,
            'order' => 4,
        ]);

        // 2. Hotels (Unique)
        Hotel::create([
            'name' => 'Dian Rana Hotel',
            'description' => 'Hotel bintang 3 dengan akses langsung ke pesisir pantai.',
            'details' => 'Memiliki 40 kamar dengan fasilitas WiFi, kolam renang, dan restoran pinggir laut. Sangat direkomendasikan untuk wisatawan keluarga.',
            'location' => 'Jl. Jenderal Sudirman, Tapaktuan',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1!2d97.18!3d3.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sHotel%20Dian%20Rana!5e0!3m2!1sid!2sid!4v1773344473846!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'rating' => 4.8,
            'price' => 650000,
            'category' => 'Hotel Premium',
            'image_url' => 'https://images.unsplash.com/photo-1542314831-c6a4d14d8373?q=80&w=2670&auto=format&fit=crop',
            'is_active' => true,
            'order' => 1,
        ]);

        Hotel::create([
            'name' => 'Wisma Pala Mas',
            'description' => 'Penginapan ekonomis dengan suasana kekeluargaan.',
            'details' => 'Terletak strategis di dekat pasar kota Tapaktuan. Cocok bagi backpacker yang mencari akomodasi bersih dengan harga terjangkau.',
            'location' => 'Pusat Kota Tapaktuan',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1!2d97.19!3d3.26!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sWisma%20Pala%20Mas!5e0!3m2!1sid!2sid!4v1773344473847!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'rating' => 4.2,
            'price' => 250000,
            'category' => 'Low Budget',
            'image_url' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?q=80&w=2670&auto=format&fit=crop',
            'is_active' => true,
            'order' => 2,
        ]);

        // 3. Events (Unique)
        Event::create([
            'name' => 'Aceh Selatan Cultural Festival',
            'description' => 'Pesta budaya tahunan menampilkan tari tradisional dan kerajinan lokal.',
            'details' => 'Festival ini merayakan kekayaan budaya dari 18 kecamatan di Aceh Selatan. Saksikan tari Landok Sampot yang memukau dan pameran kuliner khas seperti jus pala.',
            'date' => '2026-08-15',
            'time' => '09:00 - 22:00',
            'location' => 'Taman Pala Indah, Tapaktuan',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1!2d97.19!3d3.26!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sTaman%20Pala%20Indah!5e0!3m2!1sid!2sid!4v1773344473848!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Budaya & Seni',
            'image_url' => 'https://images.unsplash.com/photo-1533174000273-fa20ff1124fa?q=80&w=2670&auto=format&fit=crop',
            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);

        Event::create([
            'name' => 'Tapaktuan Adventure Trail',
            'description' => 'Kompetisi off-road menantang menjelajahi perbukitan Aceh Selatan.',
            'details' => 'Diikuti oleh ratusan rider dari seluruh Sumatera. Rute melintasi hutan, sungai, dan medan ekstrem yang memacu adrenalin.',
            'date' => '2026-10-10',
            'time' => '07:00 - Selesai',
            'location' => 'Sirkuit Lhok Rukam',
            'location_url' => 'https://maps.app.goo.gl/8FiNffZzZ5RJFast8',
            'map_iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1517.1!2d97.2!3d3.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303a4de1d5fa4da3%3A0xd14c7a82f9b99873!2sLhok%20Rukam!5e0!3m2!1sid!2sid!4v1773344473849!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'category' => 'Olahraga',
            'image_url' => 'https://images.unsplash.com/photo-1544724569-5f546fd6f2b5?q=80&w=2574&auto=format&fit=crop',
            'is_featured' => false,
            'is_active' => true,
            'order' => 2,
        ]);

        // 4. Settings
        Setting::set('info_title', 'Rencanakan Petualangan Anda di Kota Naga');
        Setting::set('info_subtitle', 'Aceh Selatan (Tapaktuan)');
        Setting::set('info_description', 'Aceh Selatan bukan sekadar tujuan wisata, melainkan pengalaman yang merangkum sejarah, kebudayaan lokal, kuliner lezat, dan panorama Samudra Hindia yang luas. Kami siap menyambut Anda.');

        Setting::set('footer_about', 'Portal resmi pariwisata Kabupaten Aceh Selatan. Temukan pesona alam, budaya, dan kenikmatan kuliner yang tak terlupakan di Serambi Mekkah.');
        Setting::set('footer_address', 'Jl. Merdeka No. 12, Tapaktuan, Aceh Selatan');
        Setting::set('footer_phone', '+62 811 670 1234');
        Setting::set('footer_email', 'visit@acehselatankab.go.id');
        Setting::set('footer_copyright', 'Pemerintah Kabupaten Aceh Selatan. All Rights Reserved.');

        Setting::set('social_fb', 'https://facebook.com/wisataacehselatan');
        Setting::set('social_ig', 'https://instagram.com/pesonaacehselatan');
        Setting::set('social_tw', 'https://twitter.com/acehselatan_info');

        Setting::set('stats_destinations', '45+');
        Setting::set('stats_culinary', '60+');
        Setting::set('stats_events', '12');
        Setting::set('stats_service', '100%');

        Setting::set('terms_content', "# Syarat & Ketentuan\n\nSelamat datang di Raja Wisata...");
        Setting::set('guide_content', "PANDUAN WISATA ACEH SELATAN\nKota Naga, Negeri Pala...");
        
        Setting::set('info_feature_1_title', 'Akses Transportasi');
        Setting::set('info_feature_1_desc', 'Tersedia penerbangan ke Bandara Cut Ali atau perjalanan darat lintas Sumatera.');
        Setting::set('info_feature_2_title', 'Pusat Budaya');
        Setting::set('info_feature_2_desc', 'Gali kearifan lokal melalui interaksi langsung bersama dinas pariwisata.');
        Setting::set('info_button_text', 'Unduh Panduan Wisata (PDF)');
        Setting::set('info_button_link', '/download-guide');
        Setting::set('info_image_1', 'https://images.unsplash.com/photo-1549473889-14f410d83298?q=80&w=2670&auto=format&fit=crop');
        Setting::set('info_image_2', 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=2670&auto=format&fit=crop');
    }
}
