<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mr. Sabor Burgers — @yield('title', 'Panel')</title>
    <meta name="description" content="Mr. Sabor Burgers — Panel de usuario. Disfruta los mejores sabores.">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="dashboard-wrapper" style="padding-top: 70px;">

    {{-- ══════════════ NAVBAR UNIFICADO ══════════════ --}}
    <nav class="lp-nav" id="lp-nav">
        <a class="lp-nav-brand" href="{{ route('dashboard') }}">
            <svg viewBox="0 0 80 100" fill="none" class="logo-flame" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 4C40 4 22 22 20 38C18 48 22 54 26 58C24 50 28 44 34 42C32 50 36 56 40 60C44 56 48 50 46 42C52 44 56 50 54 58C58 54 62 48 60 38C58 22 40 4 40 4Z" fill="url(#hL1)"/>
                <path d="M40 24C40 24 30 36 30 46C30 52 34 56 40 58C46 56 50 52 50 46C50 36 40 24 40 24Z" fill="url(#hL2)" opacity="0.9"/>
                <circle cx="40" cy="50" r="5" fill="#FFE580" opacity="0.85"/>
                <defs>
                    <linearGradient id="hL1" x1="40" y1="4" x2="40" y2="60" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FF4500"/><stop offset="50%" stop-color="#E07820"/><stop offset="100%" stop-color="#FFB830"/></linearGradient>
                    <linearGradient id="hL2" x1="40" y1="24" x2="40" y2="58" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FFF176"/><stop offset="100%" stop-color="#FFB830"/></linearGradient>
                </defs>
            </svg>
            <div class="logo-text-wrap">
                <span class="logo-mr">MR. SABOR</span>
                <span class="logo-burgers">Burgers</span>
            </div>
        </a>

        <ul class="lp-nav-links">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="ph ph-house" style="margin-right: 4px; font-size: 1.1em; vertical-align: -0.1em;"></i> Inicio</a></li>
            @auth
            <li><a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}"><i class="ph ph-package" style="margin-right: 4px; font-size: 1.1em; vertical-align: -0.1em;"></i> Mis Pedidos</a></li>
            <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}"><i class="ph ph-user" style="margin-right: 4px; font-size: 1.1em; vertical-align: -0.1em;"></i> Perfil</a></li>
            @endauth
        </ul>

        <div class="lp-nav-right">
            @auth
                <div class="user-greeting-nav" style="margin-right: 0.5rem; display: flex; align-items: center;">
                    Hola, &nbsp;<strong>{{ explode(' ', Auth::user()->name)[0] }}</strong>
                </div>
                
                <a href="/#menu" class="btn btn-ghost btn-sm" style="border:1px solid rgba(255,255,255,0.05);" title="Ir al menú">
                    <i class="ph ph-fire" style="color:var(--primary);"></i> Pedir
                </a>
                
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm">
                        <i class="ph ph-gear" style="color:var(--primary-light);"></i> Admin
                    </a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm" title="Cerrar Sesión">Salir</button>
                </form>
            @else
                <a href="/" class="btn btn-primary btn-sm">Iniciar Sesión</a>
            @endauth
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main>{{ $slot }}</main>

</body>
</html>
