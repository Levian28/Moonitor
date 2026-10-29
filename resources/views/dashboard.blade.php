<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard · Moonitor</title>
    <style>
        body { margin:0; min-height:100vh; display:grid; place-items:center; background:#080022; color:#fff; font-family:system-ui,sans-serif; text-align:center; }
        img { width:11rem; margin-bottom:1.5rem; }
        button { height:2.6rem; padding:0 2rem; border:0; border-radius:4px; background:#3f5bff; color:#fff; font-weight:600; cursor:pointer; }
    </style>
</head>
<body>
    <div>
        <img src="{{ asset('images/moonitor-logo.png') }}" alt="Moonitor">
        <p>Anda sudah masuk, {{ auth()->user()->name }}.</p>
        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">KELUAR</button></form>
    </div>
</body>
</html>
