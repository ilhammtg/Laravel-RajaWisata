<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VerifyEmailOTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class EmailVerificationController extends Controller
{
    public function showVerifyForm(Request $request)
    {
        $email = $request->session()->get('verify_email');
        
        if (!$email) {
            return redirect('/login');
        }

        return Inertia::render('Auth/VerifyEmail', [
            'email' => $email
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $verification = DB::table('email_verifications')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verification) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kedaluwarsa.']);
        }

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            $user->update(['email_verified_at' => now()]);
            Auth::login($user);
            
            DB::table('email_verifications')->where('email', $request->email)->delete();
            $request->session()->forget('verify_email');

            return redirect('/dashboard');
        }

        return redirect('/login');
    }

    public function resend(Request $request)
    {
        $email = $request->session()->get('verify_email');
        
        if (!$email) {
            return response()->json(['message' => 'Sesi kedaluwarsa.'], 403);
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan.'], 404);
        }

        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        DB::table('email_verifications')->updateOrInsert(
            ['email' => $email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        try {
            $user->notify(new VerifyEmailOTP($otp));
        } catch (\Exception $e) {
            \Log::warning('OTP Resend Email failed: ' . $e->getMessage());
            if (str_contains($e->getMessage(), 'You can only send testing emails')) {
                return back()->with('warning', 'Resend limit: Email hanya bisa dikirim ke owner. OTP Developer: ' . $otp);
            }
        }

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
