<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 http://127.0.0.1:5173; style-src 'self' 'unsafe-inline' http://localhost:5173 http://127.0.0.1:5173; connect-src 'self' ws://localhost:5173 http://localhost:5173 ws://127.0.0.1:5173 http://127.0.0.1:5173; img-src 'self' data: https: http:; font-src 'self' data: http://localhost:5173 http://127.0.0.1:5173; frame-src 'self' https://www.google.com https://google.com;">

    <title inertia>Raja Wisata</title>

    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @inertiaHead
</head>

<body class="antialiased text-gray-900">
    @inertia
</body>
</html>