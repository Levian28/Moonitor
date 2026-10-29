@extends('layouts.auth')
@section('title', 'Reset PIN')
@section('content')
    <h1>Reset PIN</h1>
    <p class="lead">Masukkan email akun Anda. Tautan reset berlaku 15 menit.</p>

    <form method="POST" action="{{ route('pin.email') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" class="field" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
        @error('email') <p class="err" role="alert">{{ $message }}</p> @enderror

        <button type="submit">KIRIM TAUTAN</button>
    </form>

    <p class="help"><a href="{{ route('login') }}">Kembali ke login</a></p>
@endsection
