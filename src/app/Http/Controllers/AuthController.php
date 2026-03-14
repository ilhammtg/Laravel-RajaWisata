<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return Inertia::render('LoginPage');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return Inertia::render('RegisterPage');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Generate OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        \Illuminate\Support\Facades\DB::table('email_verifications')->updateOrInsert(
            ['email' => $user->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        try {
            $user->notify(new \App\Notifications\VerifyEmailOTP($otp));
        } catch (\Exception $e) {
            // Log for debugging but don't break the flow
            \Log::warning('OTP Email failed: ' . $e->getMessage());
            
            // If it's a Resend error about testing limits, we can inform the user in development
            if (str_contains($e->getMessage(), 'You can only send testing emails')) {
                $request->session()->flash('warning', 'Resend limit: Email hanya bisa dikirim ke owner (rajawisata001@gmail.com). OTP Developer: ' . $otp);
            }
        }

        $request->session()->put('verify_email', $user->email);

        return redirect()->route('verification.notice');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
