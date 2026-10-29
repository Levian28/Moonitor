@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <h1>Selamat Datang</h1>
    <p class="lead">Silakan masuk ke akun Anda</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="pin">Masukkan Pin Anda</label>
        <input id="pin" class="pin" name="pin" type="password"
               pattern="[0-9]*" inputmode="numeric" maxlength="4"
               placeholder="_ _ _ _" autocomplete="current-password" required autofocus>
        @error('pin') <p class="err" role="alert">{{ $message }}</p> @enderror

        <button type="submit">LOGIN</button>
    </form>

    <p class="help">Lupa PIN? <a href="{{ route('pin.forgot') }}">Reset PIN</a></p>
@endsection
