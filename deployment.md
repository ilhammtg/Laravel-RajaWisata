# Raja Wisata - Deployment Guide

Panduan ini berisi instruksi lengkap untuk menyiapkan lingkungan pengembangan (development) dan melakukan deployment ke lingkungan produksi (production) untuk proyek Raja Wisata.

---

## Persyaratan Sistem

Pastikan server atau mesin lokal Anda memenuhi persyaratan berikut:

- **PHP**: ^8.2
- **Node.js**: ^20.x
- **Database**: MySQL 8.0
- **Cache & Queue**: Redis
- **PHP Extensions**:
    - `bcmath`, `mbstring`, `exif`, `pcntl`, `gd`, `zip`, `opcache`, `pdo_mysql`, `redis`.

---

## 🏗️ Penyiapan Lingkungan Pengembangan (Local)

### 1. Menggunakan Docker (Direkomendasikan)

Proyek ini telah dilengkapi dengan konfigurasi Docker untuk memudahkan penyiapan.

1.  **Clone repositori**:
    ```bash
    git clone [url-repositori]
    cd raja_wisata
    ```
2.  **Salin file environment**:
    ```bash
    cp src/.env.example src/.env
    ```
3.  **Jalankan Docker Compose**:
    ```bash
    docker-compose up -d
    ```
4.  **Akses aplikasi**:
    - Aplikasi: `http://localhost:8000`
    - Vite Dev Server: `http://localhost:5173`
    - phpMyAdmin: `http://localhost:8080` (User: `root`, Pass: `password`)

### 2. Tanpa Docker (Manual)

1.  **Instal PHP dependencies**:
    ```bash
    cd src
    composer install
    ```
2.  **Instal Node dependencies**:
    ```bash
    npm install
    ```
3.  **Konfigurasi Database**:
    - Buat database baru di MySQL (default: `raja_wisata`).
    - Sesuaikan `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di file `.env`.
4.  **Inisialisasi Aplikasi**:
    ```bash
    php artisan key:generate
    php artisan migrate
    ```
5.  **Jalankan Server**:
    ```bash
    # Terminal 1: Laravel Server
    php artisan serve

    # Terminal 2: Vite Dev Server
    npm run dev
    ```

---

## 🚀 Deployment Produksi

### 1. Persiapan Server

Pastikan server produksi memiliki PHP 8.2, Nginx, MySQL, dan Redis yang terinstal.

### 2. Langkah-langkah Deployment

1.  **Copy file ke server** dan masuk ke direktori root proyek.
2.  **Instal Dependencies**:
    ```bash
    composer install --optimize-autoloader --no-dev
    npm install
    npm run build
    ```
3.  **Konfigurasi `.env`**:
    Pastikan variabel berikut disesuaikan:
    ```env
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=https://raja-wisata.example.com

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    ...
    ```
4.  **Optimasi Laravel**:
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan storage:link
    ```
5.  **Jalankan Migrasi Database**:
    ```bash
    php artisan migrate --force
    ```

### 3. Konfigurasi Nginx (Contoh)

```nginx
server {
    listen 80;
    server_name raja-wisata.example.com;
    root /var/www/raja_wisata/src/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. Background Jobs (Queue Worker)

Gunakan **Supervisor** untuk menjaga Laravel worker tetap berjalan di latar belakang.

Contoh konfigurasi `/etc/supervisor/conf.d/raja-wisata-worker.conf`:

```ini
[program:raja-wisata-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/raja_wisata/src/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/raja_wisata/src/storage/logs/worker.log
stopwaitsecs=3600
```

---

## 🛠️ Troubleshoot Umum

- **Permission Denied**: Pastikan folder `storage` dan `bootstrap/cache` dapat ditulis oleh web server (`chmod -R 775` & `chown -R www-data`).
- **Internal Server Error**: Periksa login di `storage/logs/laravel.log`.
- **Mix/Vite Manifest missing**: Pastikan `npm run build` telah dijalankan dengan benar.
