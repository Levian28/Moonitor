@extends('layouts.auth')
@section('title', 'PIN Baru')
@section('content')
    <h1>Buat PIN Baru</h1>
    <p class="lead">Gunakan 4 digit angka</p>

    <form method="POST" action="{{ route('pin.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <label for="pin">PIN baru</label>
        <input id="pin" class="pin" name="pin" type="password"
               pattern="[0-9]*" inputmode="numeric" maxlength="4"
               placeholder="_ _ _ _" autocomplete="new-password" required autofocus>
        @error('pin') <p class="err" role="alert">{{ $message }}</p> @enderror

        <label for="pin_confirmation" style="margin-top:1.5rem">Ulangi PIN baru</label>
        <input id="pin_confirmation" class="pin" name="pin_confirmation" type="password"
               pattern="[0-9]*" inputmode="numeric" maxlength="4"
               placeholder="_ _ _ _" autocomplete="new-password" required>

        <button type="submit" style="margin-top:2.5rem">SIMPAN PIN</button>
    </form>
@endsection
