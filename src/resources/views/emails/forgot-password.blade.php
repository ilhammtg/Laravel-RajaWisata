<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Raja Wisata</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 40px;
            text-align: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -1px;
        }
        
        .logo span {
            color: #10b981; /* Pala green */
        }
        
        .content {
            padding: 48px 40px;
            color: #334155;
            line-height: 1.6;
        }
        
        h1 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        
        p {
            margin-bottom: 24px;
            font-size: 16px;
        }
        
        .btn-container {
            text-align: center;
            margin: 40px 0;
        }
        
        .btn {
            background: #10b981;
            color: #ffffff !important;
            padding: 16px 36px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
            transition: transform 0.2s ease;
        }
        
        .footer {
            padding: 32px 40px;
            background: #f1f5f9;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        
        .footer a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }
        
        .id-badge {
            display: inline-block;
            background: #ecfdf5;
            color: #065f46;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 32px 0;
        }

        .expiry-note {
            font-size: 14px;
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ config('app.url') }}" class="logo">Raja<span>Wisata</span></a>
        </div>
        
        <div class="content">
            <div class="id-badge">Keamanan Akun</div>
            <h1>Atur Ulang Kata Sandi Anda</h1>
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Raja Wisata Anda. Jangan khawatir, kami siap membantu Anda mendapatkan akses kembali!</p>
            
            <div class="btn-container">
                <a href="{{ $url }}" class="btn">Atur Ulang Kata Sandi</a>
            </div>
            
            <p>Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini. Kata sandi Anda akan tetap aman.</p>
            
            <div class="divider"></div>
            
            <p class="expiry-note">Tautan ini akan kedaluwarsa dalam 60 menit demi keamanan akun Anda.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Raja Wisata. Seluruh hak cipta dilindungi.</p>
            <p>Punya pertanyaan? <a href="mailto:support@rajawisata.com">Hubungi Tim Support</a></p>
        </div>
    </div>
</body>
</html>
