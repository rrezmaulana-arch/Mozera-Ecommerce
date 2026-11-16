<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $demoUsers = (app()->environment('local') && config('app.demo_login', false))
            ? User::where('is_active', true)->get()
            : collect();

        return view('admin.auth.login', compact('demoUsers'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login gagal untuk akun ini. Silakan coba lagi dalam {$seconds} detik.",
            ])->withInput();
        }

        $credentials['is_active'] = true;

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['email' => 'Email atau kata sandi tidak cocok.'])->withInput();
    }

    public function quickLogin(Request $request, int $userId)
    {
        if (! (app()->environment('local') && config('app.demo_login', false))) {
            abort(404);
        }

        $user = User::where('is_active', true)->findOrFail($userId);
        Auth::login($user);
        return redirect()->route('admin.dashboard')->with('success', "Login sebagai {$user->name} ({$user->role})");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'Anda telah keluar dari sesi admin.');
    }
}
