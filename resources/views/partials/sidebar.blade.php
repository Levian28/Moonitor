<aside class="sidebar">
    <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    <nav>
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠</a>
        <a href="#" class="nav-item">📋</a>
        <a href="#" class="nav-item">🕘</a>
        <a href="#" class="nav-item">⚙️</a>
    </nav>
    <a href="#" class="nav-item logout">🚪</a>
</aside>