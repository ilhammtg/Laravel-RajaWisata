<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', [\App\Http\Controllers\LandingPageController::class, 'index'])->name('home');
Route::get('/terms', [\App\Http\Controllers\TermsController::class, 'index'])->name('terms');
Route::get('/download-guide', [\App\Http\Controllers\GuideController::class, 'download'])->name('guide.download');

// Login & Register
Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login')->middleware('guest');
    Route::post('/login', 'login')->middleware('guest');
    Route::get('/register', 'showRegister')->middleware('guest');
    Route::post('/register', 'register')->middleware('guest');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

// Password Reset Routes
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'reset'])->name('password.update');

    // Google OAuth
    Route::get('/auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);

    // Email Verification (OTP)
    Route::get('/verify-email', [\App\Http\Controllers\EmailVerificationController::class, 'showVerifyForm'])->name('verification.notice');
    Route::post('/verify-email', [\App\Http\Controllers\EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/verify-email/resend', [\App\Http\Controllers\EmailVerificationController::class, 'resend'])->name('verification.resend');
});

// Dashboard & Admin
Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class);
    Route::resource('hotels', \App\Http\Controllers\Admin\HotelController::class);
    Route::resource('culinaries', \App\Http\Controllers\Admin\CulinaryController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

// User Features
Route::middleware(['auth'])->group(function () {
    // Dashboard redirection
    Route::get('/dashboard', function() {
        if (Auth::user()->role === 'administrator') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    });

    // User Dashboard
    Route::get('/user/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');

    // Favorites
    Route::post('/favorites/toggle', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [\App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');

    // Reviews
    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    // Profile Management
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});