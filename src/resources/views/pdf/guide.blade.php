<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #059669;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #111827;
        }
        .logo span {
            color: #059669;
        }
        h1 {
            color: #064e3b;
            font-size: 24px;
            margin-top: 0;
        }
        h2 {
            color: #059669;
            border-left: 4px solid #059669;
            padding-left: 10px;
            margin-top: 30px;
        }
        h3 {
            color: #0c4a6e;
        }
        .content {
            white-space: pre-wrap;
            text-align: justify;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .meta {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Raja<span>Wisata</span></div>
        <h1>{{ $title }}</h1>
        <div class="meta">Dokumen resmi pariwisata Aceh Selatan | Dicetak pada {{ $date }}</div>
    </div>

    <div class="content">
        {!! nl2br(e($content)) !!}
    </div>

    <div class="footer">
        {{ $footer_address }} | {{ $footer_phone }} | {{ $footer_email }}
        <br>
        &copy; {{ date('Y') }} Pemerintah Kabupaten Aceh Selatan.
    </div>
</body>
</html>
