<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mr. Sabor Burgers — @yield('title', 'Panel')</title>
    <meta name="description" content="Mr. Sabor Burgers — Panel de usuario. Disfruta los mejores sabores.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-wrapper">

    {{-- ══════════════ NAVBAR ══════════════ --}}
    <nav class="navbar">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <x-application-logo />
            <div class="logo-text-wrap">
                <span class="logo-mr">MR. SABOR</span>
                <span class="logo-burgers">Burgers</span>
            </div>
        </a>

        {{-- Navegación --}}
        <ul class="navbar-nav">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">🏠 Inicio</a></li>
            <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">📦 Mis Pedidos</a></li>
            <li><a href="{{ route('profile.edit') }}">👤 Perfil</a></li>
            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('admin.dashboard') }}" style="color:var(--primary-light); font-weight:700;">⚙️ Admin</a></li>
            @endif
        </ul>

        {{-- Usuario --}}
        <div class="navbar-user">
            <span class="user-greeting">Hola, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">Salir</button>
            </form>
        </div>

    </nav>

    {{-- CONTENIDO --}}
    <main>{{ $slot }}</main>

</body>
</html>
