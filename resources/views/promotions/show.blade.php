<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $promotion->title }} — Mr. Sabor Burgers</title>
    <meta name="description" content="{{ $promotion->description ?? 'Promoción especial de Mr. Sabor Burgers' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── PROMO HERO ─────────────────────────────────── */
        .promo-hero {
            position: relative;
            min-height: 420px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }
        .promo-hero-bg {
            position: absolute;
            inset: 0;
            object-fit: cover;
            width: 100%;
            height: 100%;
            opacity: 0.5;
        }
        .promo-hero-fallback {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #1C1208, #2A1E12, #1A0E06);
        }
        .promo-hero-deco {
            position: absolute;
            right: 8%;
            top: 50%;
            transform: translateY(-50%);
            font-size: clamp(6rem, 18vw, 14rem);
            opacity: 0.08;
            line-height: 1;
            animation: float 4s ease-in-out infinite;
        }
        .promo-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(14,10,6,0.98) 0%, rgba(14,10,6,0.6) 40%, transparent 75%);
        }
        .promo-hero-content {
            position: relative;
            z-index: 2;
            padding: 3rem 2rem 3.5rem;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── PROMO DETAIL BODY ────────────────────────── */
        .promo-body {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem 5rem;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 2.5rem;
            align-items: start;
        }
        @media (max-width: 900px) {
            .promo-body { grid-template-columns: 1fr; }
        }

        /* ── OTRAS PROMOS ─────────────────────────────── */
        .other-promo-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            gap: 1rem;
            align-items: center;
            padding: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .other-promo-card:hover {
            border-color: rgba(224,120,32,0.35);
            transform: translateX(4px);
            background: rgba(255,255,255,0.02);
        }
        .other-promo-thumb {
            width: 64px; height: 64px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid var(--border);
        }
        .other-promo-emoji {
            width: 64px; height: 64px;
            border-radius: 10px;
            background: var(--bg-elevated);
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
        }

        /* ── MENÚ MINI ────────────────────────────────── */
        .menu-mini-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.875rem;
        }
        .menu-mini-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        .menu-mini-card:hover {
            border-color: rgba(224,120,32,0.3);
            transform: translateY(-3px);
        }
        .menu-mini-emoji { font-size: 1.8rem; margin-bottom: 0.4rem; }
        .menu-mini-name  { font-family: 'Bebas Neue', sans-serif; font-size: 0.95rem; letter-spacing: 1.5px; color: var(--text-light); }
        .menu-mini-price { font-size: 0.85rem; color: var(--primary-light); font-weight: 700; margin-top: 0.2rem; }
    </style>
</head>
<body style="background:var(--bg-main); min-height:100vh;">

{{-- NAVBAR --}}
<nav class="navbar" style="background:rgba(14,10,6,0.97); backdrop-filter:blur(20px);">
    <a href="/" class="navbar-brand">
        <svg viewBox="0 0 80 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="logo-flame">
            <path d="M40 4C40 4 22 22 20 38C18 48 22 54 26 58C24 50 28 44 34 42C32 50 36 56 40 60C44 56 48 50 46 42C52 44 56 50 54 58C58 54 62 48 60 38C58 22 40 4 40 4Z" fill="url(#dL1)"/>
            <path d="M40 24C40 24 30 36 30 46C30 52 34 56 40 58C46 56 50 52 50 46C50 36 40 24 40 24Z" fill="url(#dL2)" opacity="0.9"/>
            <circle cx="40" cy="50" r="5" fill="#FFE580" opacity="0.85"/>
            <defs>
                <linearGradient id="dL1" x1="40" y1="4" x2="40" y2="60" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FF4500"/><stop offset="50%" stop-color="#E07820"/><stop offset="100%" stop-color="#FFB830"/></linearGradient>
                <linearGradient id="dL2" x1="40" y1="24" x2="40" y2="58" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#FFF176"/><stop offset="100%" stop-color="#FFB830"/></linearGradient>
            </defs>
        </svg>
        <div class="logo-text-wrap">
            <span class="logo-mr">MR. SABOR</span>
            <span class="logo-burgers">Burgers</span>
        </div>
    </a>
    <div style="display:flex; gap:0.75rem; align-items:center;">
        <a href="/" class="btn btn-ghost btn-sm">← Volver al menú</a>
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Pedir ahora 🔥</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Pedir ahora 🔥</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="promo-hero">
    @if($promotion->image_url)
        <img src="{{ $promotion->image_url }}" class="promo-hero-bg" alt="{{ $promotion->title }}">
    @else
        <div class="promo-hero-fallback"></div>
        <div class="promo-hero-deco">🍔</div>
    @endif
    <div class="promo-hero-overlay"></div>

    <div class="promo-hero-content">
        {{-- Breadcrumb --}}
        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1.25rem;">
            <a href="/" style="color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.82rem; transition:color 0.3s;"
               onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">
                Inicio
            </a>
            <span style="color:rgba(255,255,255,0.3); font-size:0.78rem;">›</span>
            <span style="color:rgba(255,255,255,0.5); font-size:0.82rem;">Promociones</span>
            <span style="color:rgba(255,255,255,0.3); font-size:0.78rem;">›</span>
            <span style="color:var(--primary-light); font-size:0.82rem; font-weight:600;">{{ $promotion->title }}</span>
        </div>

        @if($promotion->badge_text)
            <div style="display:inline-block; background:linear-gradient(135deg,var(--primary),var(--primary-dark)); color:#fff;
                        font-family:'Bebas Neue',sans-serif; font-size:1.05rem; letter-spacing:2px;
                        padding:0.35rem 1.25rem; border-radius:20px; margin-bottom:1rem;
                        box-shadow:0 4px 20px rgba(224,120,32,0.45);">
                {{ $promotion->badge_text }}
            </div>
        @endif

        @if($promotion->subtitle)
            <p style="font-family:'Dancing Script',cursive; font-size:1.15rem; color:var(--accent-light); margin-bottom:0.5rem;">
                {{ $promotion->subtitle }}
            </p>
        @endif

        <h1 style="font-family:'Bebas Neue',sans-serif; font-size:clamp(2.5rem,6vw,4.5rem); letter-spacing:4px;
                   color:#fff; line-height:1; margin-bottom:1rem; text-shadow:0 4px 20px rgba(0,0,0,0.5);">
            {{ $promotion->title }}
        </h1>

        @auth
            <a href="{{ route('dashboard') }}"
               class="btn btn-primary"
               style="font-size:1rem; padding:0.875rem 2rem; box-shadow:0 8px 32px rgba(224,120,32,0.45);">
                🔥 Aprovechar oferta
            </a>
        @else
            <a href="{{ route('register') }}"
               class="btn btn-primary"
               style="font-size:1rem; padding:0.875rem 2rem; box-shadow:0 8px 32px rgba(224,120,32,0.45);">
                🔥 Regístrate y aprovecha
            </a>
        @endauth
    </div>
</section>

{{-- CUERPO --}}
<div class="promo-body">

    {{-- Columna principal --}}
    <div>
        {{-- Descripción completa --}}
        @if($promotion->description)
        <div class="admin-card" style="margin-bottom:2rem;">
            <div class="admin-card-header">
                <span class="admin-card-title">📋 Detalles de la promoción</span>
            </div>
            <div class="admin-card-body">
                <p style="color:var(--text-mid); line-height:1.85; font-size:0.95rem; white-space:pre-line;">{{ $promotion->description }}</p>
            </div>
        </div>
        @endif

        {{-- Items del menú relacionados (todos los disponibles) --}}
        @if($menuItems->isNotEmpty())
        <div>
            <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.25rem;">
                <span style="font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:3px; color:var(--text-light);">
                    🍔 Elige tu pedido
                </span>
                <div style="flex:1; height:1px; background:var(--border);"></div>
            </div>
            <p style="color:var(--text-muted); font-size:0.85rem; margin-bottom:1.25rem;">
                Inicia sesión o regístrate para pedir y aprovechar esta promoción.
            </p>
            <div class="menu-mini-grid">
                @foreach($menuItems->flatten()->take(8) as $item)
                <a href="{{ auth()->check() ? route('dashboard') : route('register') }}" class="menu-mini-card">
                    <div class="menu-mini-emoji">
                        @if($item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                 style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                        @elseif($item->category === 'Burgers') <i class="ph ph-hamburger"></i>
                        @elseif($item->category === 'Salchipapas') <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M64,120 L80,232 L176,232 L192,120 Z"/><path d="M64,120 Q128,150 192,120"/><line x1="96" y1="128" x2="88" y2="56"/><line x1="128" y1="135" x2="128" y2="40"/><line x1="160" y1="128" x2="168" y2="64"/></svg>
                        @elseif($item->category === 'Hot Dogs') <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M48,104 C48,64 208,64 208,104"/><path d="M48,152 C48,192 208,192 208,152"/><rect x="24" y="104" width="208" height="48" rx="24"/><path d="M64,128 Q80,112 96,128 T128,128 T160,128 T192,128" stroke-width="12"/></svg>
                        @elseif($item->category === 'Platos') <i class="ph ph-fork-knife"></i>
                        @elseif($item->category === 'Bebidas') <i class="ph ph-coffee"></i>
                        @elseif($item->category === 'Postres') <i class="ph ph-ice-cream"></i>
                        @else <i class="ph ph-star"></i>
                        @endif
                    </div>
                    <div class="menu-mini-name">{{ strtoupper($item->name) }}</div>
                    <div class="menu-mini-price">{{ $item->price_formatted }}</div>
                </a>
                @endforeach
            </div>
            @if($menuItems->flatten()->count() > 8)
                <div style="margin-top:1.25rem; text-align:center;">
                    <a href="{{ url('/') }}#{{ Str::slug($menuItems->keys()->first()) }}" class="btn btn-ghost btn-sm">
                        Ver menú completo →
                    </a>
                </div>
            @endif
        </div>
        @endif
    </div>

    {{-- Sidebar derecho --}}
    <div style="display:flex; flex-direction:column; gap:1.25rem;">

        {{-- CTA principal --}}
        <div style="background:linear-gradient(135deg, rgba(224,120,32,0.12), rgba(200,144,42,0.06));
                    border:1px solid rgba(224,120,32,0.25); border-radius:var(--radius); padding:1.75rem; text-align:center;">
            <div style="font-size:3rem; margin-bottom:0.75rem;">🔥</div>
            <h3 style="font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:2px; color:var(--text-light); margin-bottom:0.5rem;">
                ¡No te la pierdas!
            </h3>
            <p style="font-size:0.83rem; color:var(--text-muted); margin-bottom:1.25rem;">
                Pide ahora y disfruta de esta promoción especial.
            </p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-full">Pedir ahora 🔥</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-full" style="margin-bottom:0.6rem;">Crear cuenta gratis</a>
                <a href="{{ route('login') }}"    class="btn btn-ghost btn-full">Ya tengo cuenta</a>
            @endauth
        </div>

        {{-- Otras promociones --}}
        @if($otherPromos->isNotEmpty())
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title">🎉 Otras promociones</span>
            </div>
            <div class="admin-card-body" style="display:flex; flex-direction:column; gap:0.75rem;">
                @foreach($otherPromos as $other)
                <a href="{{ route('promotions.show', $other) }}" class="other-promo-card">
                    @if($other->image_url)
                        <img src="{{ $other->image_url }}" class="other-promo-thumb" alt="{{ $other->title }}">
                    @else
                        <div class="other-promo-emoji">🎉</div>
                    @endif
                    <div>
                        @if($other->badge_text)
                            <span style="font-size:0.68rem; background:rgba(224,120,32,0.12); color:var(--primary-light);
                                         border:1px solid rgba(224,120,32,0.2); padding:0.1rem 0.5rem; border-radius:10px; display:inline-block; margin-bottom:0.25rem;">
                                {{ $other->badge_text }}
                            </span>
                        @endif
                        <div style="font-weight:700; font-size:0.875rem; color:var(--text-light);">{{ $other->title }}</div>
                        @if($other->subtitle)
                            <div style="font-size:0.75rem; color:var(--text-muted);">{{ $other->subtitle }}</div>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Footer --}}
<footer style="border-top:1px solid var(--border); padding:1.5rem 2rem; text-align:center; color:var(--text-muted); font-size:0.82rem;">
    © {{ date('Y') }} <span style="color:var(--primary); font-weight:600;">Mr. Sabor Burgers</span> — Todos los derechos reservados.
</footer>

</body>
</html>
