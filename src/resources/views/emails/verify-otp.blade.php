<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Raja Wisata</title>
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
        
        .otp-container {
            text-align: center;
            margin: 40px 0;
            padding: 32px;
            background: #f8fafc;
            border: 2px dashed #e2e8f0;
            border-radius: 20px;
        }
        
        .otp-code {
            font-size: 48px;
            font-weight: 800;
            color: #10b981;
            letter-spacing: 12px;
            margin: 0;
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
            <div class="id-badge">Verifikasi Akun</div>
            <h1>Verifikasi Alamat Email Anda</h1>
            <p>Halo <strong>{{ $name }}</strong>,</p>
            <p>Terima kasih telah bergabung dengan Raja Wisata! Kami sangat senang Anda berada di sini. Untuk mulai menjelajahi pesona Aceh Selatan, silakan gunakan kode OTP di bawah ini untuk memverifikasi email Anda:</p>
            
            <div class="otp-container">
                <p style="margin-bottom: 8px; font-size: 14px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 1px;">Kode OTP Anda</p>
                <h2 class="otp-code">{{ $otp }}</h2>
            </div>
            
            <p>Masukkan kode ini pada halaman verifikasi untuk mengaktifkan akun Anda.</p>
            
            <div class="divider"></div>
            
            <p class="expiry-note">Kode ini akan kedaluwarsa dalam 10 menit demi keamanan akun Anda. Jika Anda tidak merasa mendaftar, silakan abaikan email ini.</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Raja Wisata. Seluruh hak cipta dilindungi.</p>
            <p>Butuh bantuan? <a href="mailto:support@rajawisata.com">Hubungi Tim Kami</a></p>
        </div>
    </div>
</body>
</html>
