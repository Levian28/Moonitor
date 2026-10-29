<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · Moonitor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#080022; --ink:#fff; --muted:#c9c6dc; --btn:#3f5bff; --link:#5aa9ff; --err:#ff8a80; --ok:#7be3a2; }
        * { box-sizing:border-box; }
        html, body { height:100%; margin:0; }
        body { display:grid; grid-template-columns:minmax(0,5fr) minmax(0,7fr); background:var(--bg); color:var(--ink);
               font:400 .95rem/1.5 "Jost", system-ui, sans-serif; }
        .photo { background:#111 url('{{ asset('images/login-cows.jpg') }}') center/cover no-repeat; min-height:100vh; }
        .panel { display:flex; align-items:center; justify-content:center; padding:2rem 1.5rem; }
        .box { width:100%; max-width:22rem; text-align:center; }
        .logo { display:block; width:11rem; max-width:70%; height:auto; margin:0 auto 2.25rem; }
        h1 { margin:0; font-size:.95rem; font-weight:600; }
        .lead { margin:0 0 2rem; }
        label { display:block; margin-bottom:1rem; font-weight:600; }
        input.pin { display:block; width:15rem; max-width:100%; height:2.9rem; margin:0 auto; padding:0 .5rem; border:0; border-radius:4px;
                    background:#fff; color:#111; font:600 1.4rem "Jost", sans-serif; letter-spacing:.9rem; text-indent:.9rem; text-align:center; }
        input.pin::placeholder { color:#555; letter-spacing:.6rem; font-weight:400; }
        input.field { display:block; width:100%; height:2.9rem; padding:0 .8rem; border:0; border-radius:4px; background:#fff; color:#111; font:inherit; }
        button { display:block; width:100%; margin-top:3rem; height:2.7rem; border:0; border-radius:4px; background:var(--btn); color:#fff;
                 font:600 .9rem "Jost", sans-serif; letter-spacing:.02em; cursor:pointer; }
        button:hover { filter:brightness(1.12); }
        input:focus-visible, button:focus-visible, a:focus-visible { outline:3px solid #9fb0ff; outline-offset:2px; }
        .help { margin-top:2.5rem; font-size:.85rem; }
        a { color:var(--link); text-decoration:none; }
        a:hover { text-decoration:underline; }
        .err { margin:.6rem 0 0; color:var(--err); font-size:.85rem; }
        .ok { margin:0 0 1.25rem; color:var(--ok); font-size:.9rem; }
        @media (max-width:760px) {
            body { grid-template-columns:1fr; }
            .photo { display:none; }
        }
    </style>
</head>
<body>
    <div class="photo" role="img" aria-label="Sapi di kandang"></div>
    <main class="panel">
        <div class="box">
            <img class="logo" src="{{ asset('images/moonitor-logo.png') }}" alt="Moonitor – Monitoring Kandang Sapi">
            @if (session('status'))
                <p class="ok" role="status">{{ session('status') }}</p>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
