<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPinMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPinController extends Controller
{
    private const EXPIRES_MINUTES = 15;

    // Endpoint 1a: form input email
    public function showRequestForm()
    {
        return view('auth.forgot-pin');
    }

    // Endpoint 1b: kirim email berisi tautan reset
    public function sendLink(Request $request)
    {
        $data = $request->validate(['email' => ['required', 'email']]);

        $user = User::where('email', $data['email'])->first();

        if ($user) {
            $token = Str::random(60);

            // Token disimpan sebagai hash; versi mentah hanya ada di email.
            DB::table('pin_resets')->updateOrInsert(
                ['email' => $user->email],
                ['token' => Hash::make($token), 'created_at' => now()]
            );

            $url = route('pin.reset', ['token' => $token, 'email' => $user->email]);
            Mail::to($user->email)->send(new ForgotPinMail($url, self::EXPIRES_MINUTES));
        }

        // Respons sama untuk email terdaftar maupun tidak (mencegah enumerasi akun).
        return back()->with('status', 'Jika email terdaftar, tautan reset PIN sudah dikirim.');
    }

    // Endpoint 2: validasi token dari tautan, tampilkan form PIN baru
    public function showResetForm(Request $request, string $token)
    {
        $email = (string) $request->query('email');

        if (! $this->validRecord($email, $token)) {
            return redirect()->route('pin.forgot')
                ->withErrors(['email' => 'Tautan tidak valid atau sudah kedaluwarsa. Minta tautan baru.']);
        }

        return view('auth.reset-pin', compact('token', 'email'));
    }

    // Endpoint 3: simpan PIN baru, hapus token
    public function reset(Request $request)
    {
        $data = $request->validate([
            'token' => ['required', 'string'],
            'email' => ['required', 'email'],
            'pin'   => ['required', 'digits:4', 'confirmed'],
        ]);

        if (! $this->validRecord($data['email'], $data['token'])) {
            return redirect()->route('pin.forgot')
                ->withErrors(['email' => 'Tautan tidak valid atau sudah kedaluwarsa. Minta tautan baru.']);
        }

        User::where('email', $data['email'])->update(['pin' => Hash::make($data['pin'])]);
        DB::table('pin_resets')->where('email', $data['email'])->delete();

        return redirect()->route('login')->with('status', 'PIN diperbarui. Silakan masuk.');
    }

    private function validRecord(string $email, string $token): bool
    {
        $record = DB::table('pin_resets')->where('email', $email)->first();

        if (! $record) {
            return false;
        }

        if (Carbon::parse($record->created_at)->lt(Carbon::now()->subMinutes(self::EXPIRES_MINUTES))) {
            DB::table('pin_resets')->where('email', $email)->delete();
            return false;
        }

        return Hash::check($token, $record->token);
    }
}
