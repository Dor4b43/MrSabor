<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — Mr. Sabor Burgers</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ══ ADMIN LAYOUT ══════════════════════════════════════ */
        .admin-shell {
            display: flex;
            min-height: 100vh;
            background: var(--bg-deep);
        }
        /* sidebar */
        .admin-sidebar {
            width: 260px;
            flex-shrink: 0;
            background: var(--bg-mid);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.25rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .sidebar-logo {
            width: 52px; height: 52px;
            border-radius: 14px;
            overflow: hidden;
            flex-shrink: 0;
            background: #0e0a06;
            border: 1.5px solid rgba(224,120,32,0.35);
            box-shadow: 0 0 14px rgba(224,120,32,0.4), 0 4px 12px rgba(0,0,0,0.5);
            display: flex; align-items: center; justify-content: center;
        }
        .sidebar-logo img {
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .sidebar-logo-fallback {
            font-size: 1.6rem;
        }
        .sidebar-brand-text { line-height: 1.15; }
        .sidebar-brand-main {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.1rem;
            letter-spacing: 2px;
            color: var(--text-light);
        }
        .sidebar-brand-sub {
            font-size: 0.65rem;
            color: var(--primary-light);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .sidebar-admin-badge {
            margin: 0.75rem 1.25rem;
            background: rgba(224,120,32,0.12);
            border: 1px solid rgba(224,120,32,0.2);
            border-radius: 8px;
            padding: 0.6rem 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .sidebar-admin-name { font-size: 0.8rem; color: var(--text-mid); font-weight: 600; }
        .sidebar-admin-role { font-size: 0.7rem; color: var(--primary-light); }
        .sidebar-nav { padding: 0.5rem 0; flex: 1; }
        .sidebar-section-label {
            padding: 0.875rem 1.25rem 0.4rem;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--text-muted);
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1.25rem;
            color: var(--text-mid);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.25s ease;
            border-left: 3px solid transparent;
            margin: 1px 0;
        }
        .sidebar-link:hover, .sidebar-link.active {
            color: var(--text-light);
            background: rgba(224,120,32,0.08);
            border-left-color: var(--primary);
        }
        .sidebar-link.active { color: var(--primary-light); background: rgba(224,120,32,0.12); }
        .sidebar-icon { width: 20px; text-align: center; font-size: 1.05rem; }
        .sidebar-bottom { padding: 1rem; border-top: 1px solid var(--border); }

        /* main */
        .admin-main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .admin-topbar {
            padding: 1rem 2rem;
            background: rgba(14,10,6,0.8);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .admin-topbar h1 { font-size: 1.2rem; font-weight: 700; color: var(--text-light); }
        .admin-topbar-sub { font-size: 0.8rem; color: var(--text-muted); margin-top: 0.1rem; }
        .admin-body { padding: 2rem; flex: 1; max-width: 1400px; width: 100%; }

        /* Flash message */
        .flash-msg {
            padding: 0.875rem 1.25rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
            border-left: 4px solid;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .flash-success { background: rgba(120,200,100,0.1); border-color: #6dc558; color: #a8e89a; }
        .flash-error   { background: rgba(224,82,82,0.1); border-color: #e05252; color: #fca5a5; }

        /* Admin cards */
        .admin-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .admin-card-title { font-size: 1rem; font-weight: 700; color: var(--text-light); }
        .admin-card-body { padding: 1.5rem; }

        /* Table */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            padding: 0.75rem 1rem;
            background: var(--bg-elevated);
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }
        .admin-table td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            font-size: 0.875rem;
            color: var(--text-mid);
            vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        /* Status badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .badge-amber   { background: rgba(200,144,42,0.15); color: #e8b84a; border: 1px solid rgba(200,144,42,0.25); }
        .badge-orange  { background: rgba(224,120,32,0.15); color: var(--primary-light); border: 1px solid rgba(224,120,32,0.25); }
        .badge-blue    { background: rgba(59,130,246,0.15); color: #93c5fd; border: 1px solid rgba(59,130,246,0.25); }
        .badge-green   { background: rgba(109,197,88,0.15); color: #86efac; border: 1px solid rgba(109,197,88,0.25); }
        .badge-gray    { background: rgba(156,163,175,0.1); color: #9ca3af; border: 1px solid rgba(156,163,175,0.2); }

        /* Form admin */
        .admin-form-group { margin-bottom: 1.25rem; }
        .admin-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }

        /* Img preview */
        .img-preview {
            width: 80px; height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid var(--border);
        }
        .img-placeholder {
            width: 80px; height: 80px;
            background: var(--bg-elevated);
            border-radius: 10px;
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
        }

        /* status timeline */
        .status-timeline {
            display: flex;
            align-items: center;
            gap: 0;
            margin: 1.5rem 0;
        }
        .st-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }
        .st-step::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: var(--border);
            z-index: 0;
        }
        .st-step:last-child::before { display: none; }
        .st-dot {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--bg-elevated);
            border: 2px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
            transition: all 0.3s;
        }
        .st-dot.done   { background: rgba(109,197,88,0.2); border-color: #6dc558; }
        .st-dot.active { background: rgba(224,120,32,0.2); border-color: var(--primary); box-shadow: 0 0 15px rgba(224,120,32,0.3); }
        .st-label { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.5rem; text-align: center; font-weight: 600; }
        .st-line-done { background: #6dc558 !important; }

        /* Responsive */
        @media (max-width: 900px) {
            .admin-sidebar { display: none; }
            .admin-form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="admin-shell">

    {{-- ══ SIDEBAR ══════════════════════════════════════════ --}}
    <aside class="admin-sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <div class="sidebar-logo">🔥</div>
            <div class="sidebar-brand-text">
                <div class="sidebar-brand-main">MR. SABOR</div>
                <div class="sidebar-brand-sub">Panel Admin</div>
            </div>
        </a>

        <div class="sidebar-admin-badge">
            <span style="font-size:1.2rem;">👤</span>
            <div>
                <div class="sidebar-admin-name">{{ Auth::user()->name }}</div>
                <div class="sidebar-admin-role">Administrador</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section-label">General</div>
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="sidebar-icon">📊</span> Dashboard
            </a>

            <div class="sidebar-section-label">Catálogo</div>
            <a href="{{ route('admin.categories.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="sidebar-icon">📂</span> Categorías
            </a>

            <div class="sidebar-section-label">Menú</div>
            <a href="{{ route('admin.menu-items.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}">
                <span class="sidebar-icon">🍔</span> Productos del menú
            </a>
            <a href="{{ route('admin.menu-items.create') }}"
               class="sidebar-link {{ request()->routeIs('admin.menu-items.create') ? 'active' : '' }}">
                <span class="sidebar-icon">➕</span> Añadir producto
            </a>

            <div class="sidebar-section-label">Promociones</div>
            <a href="{{ route('admin.promotions.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                <span class="sidebar-icon">🎉</span> Gestionar promos
            </a>
            <a href="{{ route('admin.promotions.create') }}"
               class="sidebar-link">
                <span class="sidebar-icon">➕</span> Nueva promoción
            </a>

            <div class="sidebar-section-label">Pedidos</div>
            <a href="{{ route('admin.orders.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <span class="sidebar-icon">📦</span> Todos los pedidos
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
               class="sidebar-link">
                <span class="sidebar-icon">⏳</span> Pendientes
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'preparing']) }}"
               class="sidebar-link">
                <span class="sidebar-icon">🔥</span> En preparación
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'on_way']) }}"
               class="sidebar-link">
                <span class="sidebar-icon">🚀</span> En camino
            </a>

            <div class="sidebar-section-label">Cuenta</div>
            <a href="{{ route('dashboard') }}" class="sidebar-link">
                <span class="sidebar-icon">🏠</span> Vista cliente
            </a>
        </nav>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-full btn-sm" style="justify-content:flex-start; gap:0.6rem;">
                    🚪 Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN ══════════════════════════════════════════════ --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div>
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="admin-topbar-sub">@yield('page-subtitle', 'Panel de administración — Mr. Sabor Burgers')</div>
            </div>
            <div style="display:flex; gap:0.75rem; align-items:center;">
                @yield('topbar-actions')
            </div>
        </div>

        <div class="admin-body">
            @if(session('success'))
                <div class="flash-msg flash-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash-msg flash-error">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</div>
</body>
</html>
