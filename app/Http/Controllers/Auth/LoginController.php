<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private const MAX_ATTEMPTS = 5;
    private const LOCK_SECONDS = 900; // kunci 15 menit

    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'pin' => ['required', 'digits:4'],
        ]);

        // Tanpa email, jadi pembatasan percobaan per alamat IP.
        $key = 'pin-login|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            $minutes = (int) ceil(RateLimiter::availableIn($key) / 60);
            throw ValidationException::withMessages([
                'pin' => "Terlalu banyak percobaan. Coba lagi dalam {$minutes} menit.",
            ]);
        }

        // Cocokkan PIN ke setiap akun (hash tidak bisa dicari langsung).
        $user = User::all()->first(fn (User $u) => Hash::check($data['pin'], $u->pin));

        if (! $user) {
            RateLimiter::hit($key, self::LOCK_SECONDS);
            throw ValidationException::withMessages(['pin' => 'PIN salah.']);
        }

        RateLimiter::clear($key);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
