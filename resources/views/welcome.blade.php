<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mr. Sabor Burgers — Comida Artesanal</title>
    <meta name="description" content="Mr. Sabor Burgers — La mejor comida artesanal de la ciudad. Burgers, Salchipapas y más. Pide para llevar o a domicilio.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
/* ── RESET LOCAL ───────────────────────────────────────────── */
* { box-sizing: border-box; margin: 0; padding: 0; }

/* ── NAVBAR MCD-STYLE ──────────────────────────────────────── */
.lp-nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    height: 70px;
    background: rgba(14,10,6,0.93);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(224,160,80,0.1);
    display: flex;
    align-items: center;
    padding: 0 2rem;
    gap: 2rem;
    transition: background 0.3s;
}
.lp-nav.scrolled { background: rgba(14,10,6,0.99); }
.lp-nav-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    flex-shrink: 0;
}
.logo-nav-img {
    height: 48px;
    width: 48px;
    object-fit: cover;
    border-radius: 12px;
    border: 1.5px solid rgba(224,120,32,0.3);
    box-shadow: 0 0 12px rgba(224,120,32,0.35);
    background: #0e0a06;
}
.logo-nav-img-wrap {
    height: 48px;
    width: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.lp-nav-links {
    display: flex;
    gap: 0;
    list-style: none;
}
.lp-nav-links a {
    display: block;
    padding: 0.5rem 1.1rem;
    color: rgba(242,232,213,0.7);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: color 0.25s;
    white-space: nowrap;
}
.lp-nav-links a:hover { color: #F2E8D5; }
.lp-nav-right { margin-left: auto; display: flex; gap: 0.75rem; align-items: center; }

/* ── HERO (full viewport) ──────────────────────────────────── */
.lp-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.lp-hero-bg {
    position: absolute;
    inset: 0;
    background-image: url('/images/hero-burger.png');
    background-size: cover;
    background-position: center 40%;
    transform: scale(1.05);
    transition: transform 8s ease;
    animation: heroZoom 12s ease-in-out infinite alternate;
}
@keyframes heroZoom {
    from { transform: scale(1.0); background-position: center 40%; }
    to   { transform: scale(1.08); background-position: center 50%; }
}
.lp-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        105deg,
        rgba(14,10,6,0.93) 0%,
        rgba(14,10,6,0.75) 45%,
        rgba(14,10,6,0.3)  75%,
        rgba(14,10,6,0.15) 100%
    );
}
.lp-hero-content {
    position: relative;
    z-index: 2;
    padding: 9rem 3rem 5rem;
    max-width: 640px;
}
.lp-hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(224,120,32,0.15);
    border: 1px solid rgba(224,120,32,0.3);
    color: #F09040;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    margin-bottom: 1.5rem;
    backdrop-filter: blur(8px);
}
.lp-hero-headline {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(3rem, 7vw, 5.5rem);
    letter-spacing: 4px;
    line-height: 1.0;
    color: #F2E8D5;
    margin-bottom: 0.5rem;
}
.lp-hero-headline span { color: #F09040; }
.lp-hero-sub {
    font-family: 'Dancing Script', cursive;
    font-size: clamp(1.1rem, 2.5vw, 1.5rem);
    color: #E8B84A;
    margin-bottom: 1.5rem;
}
.lp-hero-desc {
    font-size: 0.95rem;
    color: rgba(200,180,150,0.85);
    line-height: 1.7;
    max-width: 400px;
    margin-bottom: 2.5rem;
}

/* Order type buttons */
.order-type-group {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2.5rem;
}
.order-type-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.875rem 1.75rem;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    border: none;
}
.order-type-btn.primary {
    background: linear-gradient(135deg, #E07820, #B85E10);
    color: #fff;
    box-shadow: 0 6px 28px rgba(224,120,32,0.45);
}
.order-type-btn.primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 36px rgba(224,120,32,0.6);
}
.order-type-btn.secondary {
    background: rgba(255,255,255,0.08);
    border: 2px solid rgba(255,255,255,0.2);
    color: #F2E8D5;
    backdrop-filter: blur(8px);
}
.order-type-btn.secondary:hover {
    background: rgba(255,255,255,0.14);
    border-color: rgba(224,120,32,0.4);
    transform: translateY(-3px);
}
.order-type-icon {
    font-size: 1.2rem;
    line-height: 1;
}

/* Info pills (hours, location) */
.hero-info-pills {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}
.hero-info-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    font-size: 0.8rem;
    color: rgba(200,180,150,0.7);
    background: rgba(255,255,255,0.05);
    padding: 0.35rem 0.875rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.07);
}

/* Scroll indicator */
.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.4rem;
    color: rgba(200,180,150,0.5);
    font-size: 0.72rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    animation: bounceDown 2s ease-in-out infinite;
}
@keyframes bounceDown {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50%      { transform: translateX(-50%) translateY(8px); }
}
.scroll-arrow {
    width: 28px; height: 28px;
    border: 1.5px solid rgba(224,120,32,0.35);
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
    margin-top: -12px;
}

/* ── PROMO CAROUSEL ────────────────────────────────────────── */
.promo-section {
    background: var(--bg-deep);
    padding: 2.5rem 2rem;
    max-width: 100%;
}
.promo-inner { max-width: 1200px; margin: 0 auto; }
.promo-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--primary-light);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}
.promo-label::after { content: ''; flex: 1; height: 1px; background: rgba(224,120,32,0.15); }

.carousel-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    border: 1px solid rgba(224,120,32,0.18);
    box-shadow: 0 16px 50px rgba(0,0,0,0.5);
}
.carousel-track { display: flex; transition: transform 0.55s cubic-bezier(0.4,0,0.2,1); }
.carousel-slide {
    min-width: 100%;
    position: relative;
    height: 280px;
    overflow: hidden;
    display: flex;
    align-items: center;
    background: #1A0E06;
}
.carousel-slide img.slide-bg {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover; opacity: 0.45;
    transition: transform 0.6s ease;
}
.carousel-slide:hover img.slide-bg { transform: scale(1.03); }
.slide-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(90deg, rgba(14,10,6,0.9) 0%, rgba(14,10,6,0.55) 55%, transparent 100%);
}
.slide-noimag {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, #1C1208, #2A1E12);
}
.slide-deco {
    position: absolute; right: 5%; top: 50%;
    transform: translateY(-50%);
    font-size: clamp(5rem, 14vw, 10rem);
    opacity: 0.1; line-height: 1;
    animation: float 4s ease-in-out infinite;
}
.slide-content {
    position: relative; z-index: 2;
    padding: 2rem 2.5rem;
    max-width: 520px;
}
.slide-badge {
    display: inline-block;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-family: 'Bebas Neue', sans-serif;
    font-size: 1rem; letter-spacing: 2px;
    padding: 0.3rem 1rem; border-radius: 20px;
    margin-bottom: 0.75rem;
    box-shadow: 0 4px 16px rgba(224,120,32,0.4);
}
.slide-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(2rem, 5vw, 3.2rem);
    letter-spacing: 3px; color: #fff; line-height: 1.05; margin-bottom: 0.5rem;
}
.slide-sub { color: #E8B84A; font-size: 0.875rem; font-style: italic; margin-bottom: 0.35rem; }
.slide-desc { color: rgba(255,255,255,0.65); font-size: 0.82rem; line-height: 1.6; }
.slide-cta {
    position: absolute; bottom: 1.25rem; right: 1.5rem; z-index: 10;
    display: inline-flex; align-items: center; gap: 0.4rem;
    background: rgba(224,120,32,0.15); backdrop-filter: blur(12px);
    border: 1px solid rgba(224,120,32,0.4); color: #F09040;
    padding: 0.45rem 1rem; border-radius: 20px;
    font-size: 0.78rem; font-weight: 600; text-decoration: none;
    transition: all 0.3s ease;
}
.slide-cta:hover { background: rgba(224,120,32,0.35); color: #fff; transform: translateY(-2px); }
.carousel-btn {
    position: absolute; top:50%; transform: translateY(-50%);
    width: 40px; height: 40px;
    background: rgba(14,10,6,0.7); border: 1px solid rgba(224,120,32,0.25);
    color: #F2E8D5; border-radius: 50%; cursor: pointer;
    font-size: 1rem; display: flex; align-items: center; justify-content: center;
    z-index: 10; transition: all 0.25s ease; backdrop-filter: blur(8px);
}
.carousel-btn:hover { background: var(--primary); border-color: var(--primary); }
.carousel-btn.prev { left: 0.875rem; }
.carousel-btn.next { right: 0.875rem; }
.carousel-dots { position: absolute; bottom: 0.875rem; left: 50%; transform: translateX(-50%); display: flex; gap: 6px; z-index: 10; }
.carousel-dot { width: 7px; height: 7px; border-radius: 50%; background: rgba(255,255,255,0.25); cursor: pointer; transition: all 0.3s; border: none; }
.carousel-dot.active { background: var(--primary); width: 22px; border-radius: 3px; }

/* ── CATEGORY BAR (sticky McDonald's style) ────────────────── */
.cat-bar-wrap {
    position: sticky;
    top: 70px;
    z-index: 900;
    background: rgba(14,10,6,0.97);
    border-bottom: 1px solid rgba(224,160,80,0.12);
    backdrop-filter: blur(16px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
}
.cat-bar {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    gap: 0;
    padding: 0 1rem;
    overflow-x: auto;
    scrollbar-width: none;
}
.cat-bar::-webkit-scrollbar { display: none; }
.cat-pill {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    padding: 1rem 1.25rem 0.875rem;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.25s ease;
    white-space: nowrap;
    min-width: 88px;
    text-decoration: none;
    color: rgba(200,180,150,0.6);
    position: relative;
}
.cat-pill:hover {
    color: #F2E8D5;
    background: rgba(224,120,32,0.06);
}
.cat-pill.active {
    color: #F09040;
    border-bottom-color: #E07820;
}
.cat-pill-icon { font-size: 1.6rem; line-height: 1; transition: transform 0.25s; }
.cat-pill:hover .cat-pill-icon,
.cat-pill.active .cat-pill-icon { transform: scale(1.15) translateY(-2px); }
.cat-pill-label { font-size: 0.72rem; font-weight: 600; letter-spacing: 0.3px; }

/* ── MENU SECTIONS ─────────────────────────────────────────── */
.menu-area { background: var(--bg-main); }
.menu-section { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem 2rem; }
.menu-section-title {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    margin-bottom: 2rem;
}
.menu-section-title h2 {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 2.2rem;
    letter-spacing: 3px;
    color: #F2E8D5;
    line-height: 1;
}
.menu-section-line { flex: 1; height: 1px; background: var(--border); }
.menu-section-count {
    font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.5px; color: var(--primary-light);
    background: rgba(224,120,32,0.12); border: 1px solid rgba(224,120,32,0.2);
    padding: 0.2rem 0.65rem; border-radius: 20px;
}

/* Product card */
.prod-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.1rem;
}
.prod-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}
.prod-card:hover {
    border-color: rgba(224,120,32,0.35);
    transform: translateY(-5px);
    box-shadow: 0 14px 40px rgba(0,0,0,0.5);
}
.prod-thumb {
    height: 155px;
    background: var(--bg-elevated);
    overflow: hidden;
    display: flex; align-items: center; justify-content: center;
    font-size: 3.5rem;
    border-bottom: 1px solid var(--border);
    position: relative;
}
.prod-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
.prod-card:hover .prod-thumb img { transform: scale(1.07); }
.prod-info { padding: 0.95rem 1rem 1.1rem; flex: 1; display: flex; flex-direction: column; }
.prod-cat-tag { font-size: 0.7rem; color: #E8B84A; font-style: italic; margin-bottom: 0.15rem; }
.prod-name { font-family: 'Bebas Neue', sans-serif; font-size: 1.1rem; letter-spacing: 1.5px; color: #F2E8D5; margin-bottom: 0.35rem; line-height: 1.15; }
.prod-desc { font-size: 0.72rem; color: #8A7460; line-height: 1.5; flex: 1; margin-bottom: 0.75rem; }
.prod-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 0.75rem; border-top: 1px solid var(--border); }
.prod-price { font-family: 'Bebas Neue', sans-serif; font-size: 1.3rem; color: #F09040; }
.prod-add {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #E07820, #B85E10);
    border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: #fff;
    box-shadow: 0 3px 10px rgba(224,120,32,0.38);
    transition: all 0.3s; text-decoration: none;
}
.prod-add:hover { transform: scale(1.15); box-shadow: 0 5px 18px rgba(224,120,32,0.55); }

/* ── ABOUT SECTION ─────────────────────────────────────────── */
.about-section {
    background: var(--bg-mid);
    border-top: 1px solid var(--border);
    padding: 5rem 2rem;
}
.about-inner { max-width: 1100px; margin: 0 auto; }
.about-eyebrow {
    font-size: 0.75rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
    color: var(--primary-light); margin-bottom: 0.75rem;
}
.about-title {
    font-family: 'Bebas Neue', sans-serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    letter-spacing: 4px; color: #F2E8D5; line-height: 1.05; margin-bottom: 1rem;
}
.about-title span { color: #F09040; }
.about-desc { color: #8A7460; font-size: 0.92rem; line-height: 1.8; max-width: 540px; margin-bottom: 3rem; }

.about-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1.25rem; }
.about-card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 1.5rem;
    transition: all 0.3s;
}
.about-card:hover { border-color: rgba(224,120,32,0.25); transform: translateY(-3px); }
.about-card-icon { font-size: 2rem; margin-bottom: 0.75rem; }
.about-card-title { font-weight: 700; font-size: 0.92rem; color: #F2E8D5; margin-bottom: 0.35rem; }
.about-card-body { font-size: 0.82rem; color: #8A7460; line-height: 1.65; }

/* ── FOOTER ────────────────────────────────────────────────── */
.lp-footer {
    background: var(--bg-deep);
    border-top: 1px solid var(--border);
    padding: 2rem;
    text-align: center;
    color: #8A7460;
    font-size: 0.82rem;
}
.lp-footer span { color: #E07820; font-weight: 600; }

/* float animation */
@keyframes float {
    0%, 100% { transform: translateY(-50%) translateY(0); }
    50%       { transform: translateY(-50%) translateY(-12px); }
}

@media (max-width: 768px) {
    .lp-hero-content { padding: 8rem 1.5rem 4rem; }
    .order-type-group { gap: 0.75rem; }
    .order-type-btn { padding: 0.75rem 1.25rem; font-size: 0.85rem; }
    .lp-nav-links { display: none; }
}
    </style>
</head>
<body style="background:#0E0A06;">

{{-- ══════════════════════════════════════════════════════════
     NAVBAR FIJO
══════════════════════════════════════════════════════════ --}}
<nav class="lp-nav" id="lp-nav">
    <a class="lp-nav-brand" href="/">
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
        <li><a href="#menu">Menú</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        @if($promotions->isNotEmpty())
            <li><a href="#promos">Promociones</a></li>
        @endif
    </ul>

    <div class="lp-nav-right">
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">🔥 Pedir ahora</a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm">⚙️ Admin</a>
            @endif
        @else
            <a href="{{ route('login') }}"    class="btn btn-ghost btn-sm">Entrar</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Crear cuenta</a>
        @endauth
    </div>
</nav>

{{-- ══════════════════════════════════════════════════════════
     HERO — PANTALLA COMPLETA
══════════════════════════════════════════════════════════ --}}
<section class="lp-hero" id="inicio">
    <div class="lp-hero-bg"></div>
    <div class="lp-hero-overlay"></div>

    <div class="lp-hero-content">
        <div class="lp-hero-eyebrow">
            🔥 Comida Artesanal Premium
        </div>

        <h1 class="lp-hero-headline">
            ¿Cómo quieres<br><span>tu pedido</span><br>hoy?
        </h1>
        <p class="lp-hero-sub">El sabor que te enamora</p>
        <p class="lp-hero-desc">
            Hamburguesas artesanales, Salchipapas especiales y Platos únicos.
            Todo hecho con ingredientes frescos y el toque especial de Mr. Sabor.
        </p>

        {{-- Botones tipo pedido --}}
        <div class="order-type-group">
            @auth
                <a href="{{ route('dashboard') }}" class="order-type-btn primary">
                    <span class="order-type-icon">🛵</span> A domicilio
                </a>
                <a href="{{ route('dashboard') }}" class="order-type-btn secondary">
                    <span class="order-type-icon">🏠</span> Para llevar
                </a>
            @else
                <a href="{{ route('register') }}" class="order-type-btn primary">
                    <span class="order-type-icon">🛵</span> A domicilio
                </a>
                <a href="{{ route('register') }}" class="order-type-btn secondary">
                    <span class="order-type-icon">🏠</span> Para llevar
                </a>
            @endauth
        </div>

        {{-- Info pills --}}
        <div class="hero-info-pills">
            <span class="hero-info-pill">⏰ Lun–Dom: 11:00am – 10:00pm</span>
            <span class="hero-info-pill">📍 Tu ciudad</span>
            <span class="hero-info-pill">📞 WhatsApp disponible</span>
        </div>
    </div>

    {{-- Flecha scroll --}}
    <div class="scroll-indicator">
        <span>Ver menú</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     CARRUSEL DE PROMOCIONES (solo si hay activas)
══════════════════════════════════════════════════════════ --}}
@if($promotions->isNotEmpty())
<section class="promo-section" id="promos">
    <div class="promo-inner">
        <div class="promo-label">🎉 Promociones especiales</div>
        <div class="carousel-wrapper" id="promo-carousel">
            <div class="carousel-track" id="carousel-track">
                @foreach($promotions as $promo)
                <div class="carousel-slide">
                    @if($promo->image_path)
                        <img src="{{ Storage::url($promo->image_path) }}" class="slide-bg" alt="{{ $promo->title }}">
                        <div class="slide-overlay"></div>
                    @else
                        <div class="slide-noimag"></div>
                        <div class="slide-deco">🍔</div>
                        <div class="slide-overlay" style="background:linear-gradient(90deg,rgba(14,10,6,0.92) 0%,rgba(14,10,6,0.6) 60%,transparent 100%);"></div>
                    @endif
                    <div class="slide-content">
                        @if($promo->badge_text) <div class="slide-badge">{{ $promo->badge_text }}</div> @endif
                        @if($promo->subtitle)   <div class="slide-sub">{{ $promo->subtitle }}</div> @endif
                        <h2 class="slide-title">{{ $promo->title }}</h2>
                        @if($promo->description) <p class="slide-desc">{{ Str::limit($promo->description, 100) }}</p> @endif
                    </div>
                    <a href="{{ route('promotions.show', $promo) }}" class="slide-cta">
                        Más detalles &nbsp;→
                    </a>
                </div>
                @endforeach
            </div>
            @if($promotions->count() > 1)
                <button class="carousel-btn prev" id="carousel-prev">&#8592;</button>
                <button class="carousel-btn next" id="carousel-next">&#8594;</button>
                <div class="carousel-dots" id="carousel-dots">
                    @foreach($promotions as $i => $promo)
                        <button class="carousel-dot {{ $i === 0 ? 'active' : '' }}" data-idx="{{ $i }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════════
     BARRA DE CATEGORÍAS STICKY (estilo McDonald's)
══════════════════════════════════════════════════════════ --}}
@if($menuItems->isNotEmpty())
<div class="cat-bar-wrap" id="menu">
    <div class="cat-bar" id="cat-bar">
        @php
            $catIcons = [
                'Burgers'      => '🍔',
                'Salchipapas'  => '🍟',
                'Platos'       => '🍽️',
                'Bebidas'      => '🥤',
                'Postres'      => '🍰',
                'Otros'        => '🌟',
            ];
        @endphp
        @foreach($menuItems->keys() as $i => $cat)
        <a class="cat-pill {{ $i === 0 ? 'active' : '' }}"
           href="#cat-{{ Str::slug($cat) }}"
           data-cat="{{ Str::slug($cat) }}"
           id="pill-{{ Str::slug($cat) }}">
            <span class="cat-pill-icon">{{ $catIcons[$cat] ?? '🌟' }}</span>
            <span class="cat-pill-label">{{ $cat }}</span>
        </a>
        @endforeach
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     SECCIONES DEL MENÚ POR CATEGORÍA
══════════════════════════════════════════════════════════ --}}
<div class="menu-area">
    @foreach($menuItems as $category => $items)
    <section id="cat-{{ Str::slug($category) }}" class="menu-section">
        <div class="menu-section-title">
            <span style="font-size:2rem; line-height:1;">{{ $catIcons[$category] ?? '🌟' }}</span>
            <h2>{{ strtoupper($category) }}</h2>
            <div class="menu-section-line"></div>
            <span class="menu-section-count">{{ $items->count() }} opciones</span>
        </div>

        <div class="prod-grid">
            @foreach($items as $item)
            <div class="prod-card">
                <div class="prod-thumb">
                    @if($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" loading="lazy">
                    @else
                        {{ $catIcons[$category] ?? '🌟' }}
                    @endif
                </div>
                <div class="prod-info">
                    <span class="prod-cat-tag">{{ $category }}</span>
                    <div class="prod-name">{{ strtoupper($item->name) }}</div>
                    @if($item->description)
                        <p class="prod-desc">{{ Str::limit($item->description, 75) }}</p>
                    @endif
                    <div class="prod-footer">
                        <span class="prod-price">{{ $item->price_formatted }}</span>
                        @auth
                            <a href="{{ route('dashboard') }}" class="prod-add" title="Ir a pedir">+</a>
                        @else
                            <a href="{{ route('register') }}" class="prod-add" title="Regístrate para pedir">+</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach
</div>
@else
<div style="text-align:center; padding:6rem 2rem; color:#8A7460; background:var(--bg-main);">
    <div style="font-size:5rem; margin-bottom:1rem;">🍽️</div>
    <h3 style="font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:3px; color:#F2E8D5; margin-bottom:0.5rem;">Menú en preparación</h3>
    <p>¡Muy pronto! El equipo de Mr. Sabor está listo para ti.</p>
</div>
@endif

{{-- ══════════════════════════════════════════════════════════
     SECCIÓN "NOSOTROS" / INFO DEL LOCAL
══════════════════════════════════════════════════════════ --}}
<section class="about-section" id="nosotros">
    <div class="about-inner">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center;">
            <div>
                <p class="about-eyebrow">¿Por qué Mr. Sabor?</p>
                <h2 class="about-title">Sabor que<br><span>te enamora</span></h2>
                <p class="about-desc">
                    En Mr. Sabor Burgers creemos que la comida rápida puede ser artesanal, fresca y deliciosa.
                    Cada burger es preparada al momento con ingredientes seleccionados y la sazón que nos hace únicos en la ciudad.
                </p>
                @auth
                    <a href="{{ route('dashboard') }}" class="order-type-btn primary" style="display:inline-flex; font-family:'Poppins',sans-serif;">
                        <span class="order-type-icon">🔥</span> Hacer mi pedido
                    </a>
                @else
                    <a href="{{ route('register') }}" class="order-type-btn primary" style="display:inline-flex; font-family:'Poppins',sans-serif;">
                        <span class="order-type-icon">🔥</span> Empezar a pedir
                    </a>
                @endauth
            </div>
            <div>
                <div class="about-grid">
                    <div class="about-card">
                        <div class="about-card-icon">🕐</div>
                        <div class="about-card-title">Horario</div>
                        <div class="about-card-body">Lunes a domingo<br><strong style="color:#F09040;">11:00am – 10:00pm</strong><br>Nunca cerramos para ti</div>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon">📍</div>
                        <div class="about-card-title">Ubicación</div>
                        <div class="about-card-body">Encuéntranos en el centro de la ciudad. Domicilios a toda el área metropolitana.</div>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon">🥩</div>
                        <div class="about-card-title">Ingredientes frescos</div>
                        <div class="about-card-body">Todo preparado al momento. Sin conservantes, sin congelados. Sabor 100% natural.</div>
                    </div>
                    <div class="about-card">
                        <div class="about-card-icon">💬</div>
                        <div class="about-card-title">Contacto</div>
                        <div class="about-card-body">WhatsApp disponible para pedidos y consultas. ¡Respuesta inmediata!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════════════════ --}}
<footer class="lp-footer">
    <p>© {{ date('Y') }} <span>Mr. Sabor Burgers</span> — Todos los derechos reservados. Hecho con ❤️ y 🔥</p>
</footer>

{{-- ══════════════════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════════════════ --}}
<script>
// ── Navbar scroll effect ──────────────────────────────────
window.addEventListener('scroll', () => {
    document.getElementById('lp-nav').classList.toggle('scrolled', window.scrollY > 30);
});

// ── Carrusel ──────────────────────────────────────────────
@if($promotions->count() > 1)
(function() {
    const track = document.getElementById('carousel-track');
    const dots  = document.querySelectorAll('.carousel-dot');
    const total = {{ $promotions->count() }};
    let current = 0, timer;

    function goTo(idx) {
        current = (idx + total) % total;
        track.style.transform = `translateX(-${current * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    document.getElementById('carousel-prev')?.addEventListener('click', () => { clearInterval(timer); goTo(current - 1); startAuto(); });
    document.getElementById('carousel-next')?.addEventListener('click', () => { clearInterval(timer); goTo(current + 1); startAuto(); });
    dots.forEach(d => d.addEventListener('click', () => { clearInterval(timer); goTo(+d.dataset.idx); startAuto(); }));

    function startAuto() { timer = setInterval(() => goTo(current + 1), 5000); }
    startAuto();
})();
@endif

// ── Barra de categorías — active pill on scroll ───────────
(function() {
    const pills    = document.querySelectorAll('.cat-pill');
    const sections = [...pills].map(p => document.getElementById('cat-' + p.dataset.cat));

    // Smooth scroll + active
    pills.forEach(pill => {
        pill.addEventListener('click', e => {
            e.preventDefault();
            const target = document.getElementById('cat-' + pill.dataset.cat);
            if (target) {
                const offset = 70 + 60; // navbar + cat-bar
                window.scrollTo({ top: target.offsetTop - offset, behavior: 'smooth' });
            }
        });
    });

    // Observer para actualizar pill activa
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id  = entry.target.id; // e.g. "cat-burgers"
                const cat = id.replace('cat-', '');
                pills.forEach(p => p.classList.toggle('active', p.dataset.cat === cat));
                // scroll pill into view on mobile
                const active = document.querySelector('.cat-pill.active');
                active?.scrollIntoView({ block: 'nearest', inline: 'center', behavior: 'smooth' });
            }
        });
    }, { rootMargin: '-30% 0px -60% 0px' });

    sections.forEach(s => s && obs.observe(s));
})();
</script>

</body>
</html>
