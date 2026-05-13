<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mr. Sabor Burgers — Comida Artesanal</title>
    <meta name="description" content="Mr. Sabor Burgers — La mejor comida artesanal de la ciudad. Burgers, Salchipapas y más. Pide para llevar o a domicilio.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
/* ── RESET LOCAL ───────────────────────────────────────────── */
* { box-sizing: border-box; margin: 0; padding: 0; }

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

/* ── CUSTOM CHECKBOX & RADIO ────────────────────────────────────────── */
.mr-checkbox {
    appearance: none;
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid rgba(224,120,32,0.4);
    border-radius: 4px;
    background: rgba(0,0,0,0.4);
    cursor: pointer;
    position: relative;
    outline: none;
    transition: all 0.2s ease;
    flex-shrink: 0;
}
.mr-checkbox:checked {
    background: #E07820;
    border-color: #E07820;
}
.mr-checkbox:checked::after {
    content: '✓';
    position: absolute;
    color: white;
    font-size: 14px;
    font-weight: 900;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.mr-radio {
    appearance: none;
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid rgba(224,120,32,0.4);
    border-radius: 50%;
    background: rgba(0,0,0,0.4);
    cursor: pointer;
    position: relative;
    outline: none;
    transition: all 0.2s ease;
    flex-shrink: 0;
}
.mr-radio:checked {
    border-color: #E07820;
}
.mr-radio:checked::after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    background: #E07820;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
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

/* ── PRODUCT MODAL ─────────────────────────────────────────── */
.product-modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
    z-index: 2000; display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
}
.product-modal-overlay.active { opacity: 1; pointer-events: auto; }
.product-modal {
    background: var(--bg-card, #1A0E06); border: 1px solid rgba(224,120,32,0.3);
    border-radius: 20px; width: 90%; max-width: 500px;
    overflow: hidden; transform: translateY(20px); transition: transform 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6); position: relative;
}
.product-modal-overlay.active .product-modal { transform: translateY(0); }
.product-modal-close {
    position: absolute; top: 1rem; right: 1rem;
    background: rgba(0,0,0,0.5); color: #fff; width: 32px; height: 32px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; border: none; font-size: 1.2rem; z-index: 10;
}
.product-modal-close:hover { background: rgba(224,120,32,0.8); }
.product-modal-img-wrap { height: 250px; background: #0E0A06; overflow: hidden; display: flex; align-items: center; justify-content: center; }
.product-modal-img { width: 100%; height: 100%; object-fit: cover; }
.product-modal-body { padding: 2rem; }
.product-modal-title { font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: #F2E8D5; letter-spacing: 1.5px; margin-bottom: 0.5rem; line-height: 1; }
.product-modal-price { font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: #F09040; margin-bottom: 1rem; }
.product-modal-desc { color: #8A7460; font-size: 0.95rem; line-height: 1.6; }

/* ── AUTH MODAL ────────────────────────────────────────────── */
.auth-modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.85); backdrop-filter: blur(8px);
    z-index: 3000; display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
}
.auth-modal-overlay.active { opacity: 1; pointer-events: auto; }
.auth-modal {
    background: var(--bg-mid, #22160D); border: 1px solid rgba(224,120,32,0.3);
    border-radius: 20px; width: 90%; max-width: 400px;
    padding: 2.5rem 2rem; position: relative;
    transform: translateY(20px); transition: transform 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.7);
}
.auth-modal-overlay.active .auth-modal { transform: translateY(0); }
.auth-modal-close {
    position: absolute; top: 1rem; right: 1rem;
    background: rgba(0,0,0,0.5); color: #fff; width: 32px; height: 32px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; border: none; font-size: 1.2rem; transition: background 0.2s;
}
.auth-modal-close:hover { background: rgba(224,120,32,0.8); }
.auth-modal-title { font-family: 'Bebas Neue', sans-serif; font-size: 2.2rem; color: #F2E8D5; letter-spacing: 2px; text-align: center; margin-bottom: 0.5rem; line-height: 1; }
.auth-modal-subtitle { text-align: center; color: #8A7460; font-size: 0.9rem; margin-bottom: 1.5rem; }
.auth-toggle-link { color: #F09040; cursor: pointer; text-decoration: none; font-weight: 600; transition: color 0.2s; }
.auth-toggle-link:hover { color: #E8B84A; }
.form-input.modal-input { background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); width: 100%; padding: 0.875rem 1rem; border-radius: 8px; color: #F2E8D5; font-family: 'Poppins', sans-serif; }
.form-input.modal-input:focus { border-color: #E07820; background: rgba(224,120,32,0.08); outline: none; }
.form-label { display: block; font-size: 0.78rem; font-weight: 700; color: #8A7460; margin-bottom: 0.45rem; text-transform: uppercase; letter-spacing: 0.8px; }

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
@media (min-width: 769px) {
    .user-greeting-nav { display: block !important; }
}
/* ── PRODUCT MODAL ─────────────────────────────────────────── */
.product-modal-overlay {
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
    z-index: 2000; display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
}
.product-modal-overlay.active { opacity: 1; pointer-events: auto; }
.product-modal {
    background: var(--bg-card, #1A0E06); border: 1px solid rgba(224,120,32,0.3);
    border-radius: 20px; width: 90%; max-width: 500px;
    overflow: hidden; transform: translateY(20px); transition: transform 0.3s ease;
    box-shadow: 0 20px 60px rgba(0,0,0,0.6); position: relative;
}
.product-modal-overlay.active .product-modal { transform: translateY(0); }
.product-modal-close {
    position: absolute; top: 1rem; right: 1rem;
    background: rgba(0,0,0,0.5); color: #fff; width: 32px; height: 32px;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    cursor: pointer; border: none; font-size: 1.2rem; z-index: 10;
}
.product-modal-close:hover { background: rgba(224,120,32,0.8); }
.product-modal-img-wrap { height: 250px; background: #0E0A06; overflow: hidden; display: flex; align-items: center; justify-content: center; }
.product-modal-img { width: 100%; height: 100%; object-fit: cover; }
.product-modal-body { padding: 2rem; }
.product-modal-title { font-family: 'Bebas Neue', sans-serif; font-size: 2rem; color: #F2E8D5; letter-spacing: 1.5px; margin-bottom: 0.5rem; line-height: 1; }
.product-modal-price { font-family: 'Bebas Neue', sans-serif; font-size: 1.5rem; color: #F09040; margin-bottom: 1rem; }
.product-modal-desc { color: #8A7460; font-size: 0.95rem; line-height: 1.6; }
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

    <div class="lp-nav-right" style="display:flex; align-items:center; gap:0.5rem;">
        @auth
            <div class="user-greeting-nav" style="font-size:0.85rem; color:#8A7460; margin-right:0.5rem; display:none;">
                Hola, <strong style="color:#F2E8D5;">{{ explode(' ', Auth::user()->name)[0] }}</strong>
            </div>
            <a onclick="openCheckoutModal()" class="btn btn-ghost btn-sm" style="cursor:pointer; position:relative; padding: 0.5rem 0.6rem; border: 1px solid rgba(224,120,32,0.3); display:flex; align-items:center; overflow:visible;" title="Ver mi carrito">
                <i class="ph ph-shopping-cart" style="font-size: 1.25rem; color: var(--primary-light);"></i>
                <span id="nav-cart-badge" style="position:absolute; top:-6px; right:-6px; background:#ef4444; color:white; font-size:0.7rem; font-weight:800; border-radius:10px; min-width:18px; height:18px; display:none; align-items:center; justify-content:center; box-shadow:0 2px 4px rgba(0,0,0,0.5); z-index:10; border: 2px solid #1a1512;">0</span>
            </a>
            <a href="#menu" class="btn btn-ghost btn-sm" style="border:1px solid rgba(255,255,255,0.05);" title="Ir al menú"><i class="ph ph-fire" style="color:var(--primary);"></i> Pedir</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-ghost btn-sm" title="Mi Perfil"><i class="ph ph-user"></i> Perfil</a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost btn-sm"><i class="ph ph-gear"></i> Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm" title="Cerrar Sesión">Salir</button>
            </form>
        @else
            <a onclick="openAuthModal('login')" class="btn btn-ghost btn-sm" style="cursor:pointer;">Entrar</a>
            <a onclick="openAuthModal('register')" class="btn btn-primary btn-sm" style="cursor:pointer;">Crear cuenta</a>
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
            <i class="ph ph-fire"></i> Comida Artesanal Premium
        </div>

        <h1 class="lp-hero-headline">
            ¿Cómo quieres<br><span>tu pedido</span><br>hoy?
        </h1>
        <p class="lp-hero-sub">El sabor que te enamora</p>
        <p class="lp-hero-desc">
            Hamburguesas artesanales, Salchipapas especiales y Platos únicos.
            Todo hecho con ingredientes frescos y el toque especial de Mr. Sabor.
        </p>



        {{-- Info pills --}}
        <div class="hero-info-pills">
            <span class="hero-info-pill">⏰ Lun–Dom: 6:00pm – 11:00pm</span>
            <span class="hero-info-pill">📍 Neiva-Huila</span>
            <span class="hero-info-pill">📞 3102632358</span>
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
                    @if($promo->image_url)
                        <img src="{{ $promo->image_url }}" class="slide-bg" alt="{{ $promo->title }}">
                        <div class="slide-overlay"></div>
                    @else
                        <div class="slide-noimag"></div>
                        <div class="slide-deco"><i class="ph ph-hamburger"></i></div>
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
<div class="cat-bar-wrap" id="menu" style="scroll-margin-top: 80px;">
    <div class="cat-bar" id="cat-bar">
        @php
            $catIcons = [
                'Burgers'      => '<i class="ph ph-hamburger"></i>',
                'Hamburguesas' => '<i class="ph ph-hamburger"></i>',
                'Salchipapas'  => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M64,120 L80,232 L176,232 L192,120 Z"/><path d="M64,120 Q128,150 192,120"/><line x1="96" y1="128" x2="88" y2="56"/><line x1="128" y1="135" x2="128" y2="40"/><line x1="160" y1="128" x2="168" y2="64"/></svg>',
                'Papas'        => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M64,120 L80,232 L176,232 L192,120 Z"/><path d="M64,120 Q128,150 192,120"/><line x1="96" y1="128" x2="88" y2="56"/><line x1="128" y1="135" x2="128" y2="40"/><line x1="160" y1="128" x2="168" y2="64"/></svg>',
                'Hot Dogs'     => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M48,104 C48,64 208,64 208,104"/><path d="M48,152 C48,192 208,192 208,152"/><rect x="24" y="104" width="208" height="48" rx="24"/><path d="M64,128 Q80,112 96,128 T128,128 T160,128 T192,128" stroke-width="12"/></svg>',
                'Perros'       => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="none" stroke="currentColor" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 256 256"><path d="M48,104 C48,64 208,64 208,104"/><path d="M48,152 C48,192 208,192 208,152"/><rect x="24" y="104" width="208" height="48" rx="24"/><path d="M64,128 Q80,112 96,128 T128,128 T160,128 T192,128" stroke-width="12"/></svg>',
                'Picadas'      => '<i class="ph ph-bowl-food"></i>',
                'Platos'       => '<i class="ph ph-fork-knife"></i>',
                'Bebidas'      => '<i class="ph ph-coffee"></i>',
                'Postres'      => '<i class="ph ph-ice-cream"></i>',
                'Otros'        => '<i class="ph ph-star"></i>',
            ];
        @endphp
        @foreach($menuItems->keys() as $i => $cat)
        <a class="cat-pill {{ $i === 0 ? 'active' : '' }}"
           href="#cat-{{ Str::slug($cat) }}"
           data-cat="{{ Str::slug($cat) }}"
           id="pill-{{ Str::slug($cat) }}">
            <span class="cat-pill-icon">{!! $catIcons[$cat] ?? '<i class="ph ph-star"></i>' !!}</span>
            <span class="cat-pill-label">{{ $cat }}</span>
        </a>
        @endforeach
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     SECCIONES DEL MENÚ POR CATEGORÍA
══════════════════════════════════════════════════════════ --}}
<form id="order-form" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="menu-area">
    @foreach($menuItems as $category => $items)
    <section id="cat-{{ Str::slug($category) }}" class="menu-section">
        <div class="menu-section-title">
            <span style="font-size:2rem; line-height:1;">{!! $catIcons[$category] ?? '<i class="ph ph-star"></i>' !!}</span>
            <h2>{{ strtoupper($category) }}</h2>
            <div class="menu-section-line"></div>
            <span class="menu-section-count">{{ $items->count() }} opciones</span>
        </div>

        <div class="prod-grid">
            @foreach($items as $item)
            <div class="prod-card" data-id="{{ $item->id }}" style="cursor:pointer;"
                 data-name="{{ strtoupper($item->name) }}"
                 data-price="{{ $item->price_formatted }}"
                 data-raw-price="{{ (float)$item->price }}"
                 data-custom="{{ json_encode($item->customizations) }}"
                 data-desc="{{ $item->description }}"
                 data-img="{{ $item->image_url }}"
                 data-emoji="{{ $category === 'Hamburguesas' || $category === 'Burgers' ? '🍔' : ($category === 'Salchipapas' || $category === 'Papas' ? '🍟' : ($category === 'Bebidas' ? '🥤' : '✨')) }}"
                 onclick="openProductModal(this)">
                <div class="prod-thumb">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy">
                    @else
                        {!! $catIcons[$category] ?? '<i class="ph ph-star"></i>' !!}
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
                            <div style="display:flex; align-items:center; gap:0.5rem;" onclick="event.stopPropagation()">
                                <button type="button" onclick="changeQty({{ $item->id }}, -1)"
                                    style="width:28px; height:28px; border-radius:50%; background:var(--bg-elevated, #372618); border:1px solid rgba(224,160,80,0.14); color:#F2E8D5; cursor:pointer; font-size:1rem; display:flex; align-items:center; justify-content:center;">−</button>
                                <span id="qty-display-{{ $item->id }}"
                                      style="min-width:20px; text-align:center; font-weight:700; color:#F2E8D5;">0</span>
                                <button type="button" onclick="changeQty({{ $item->id }}, 1)"
                                    class="prod-add">+</button>
                            </div>
                        @else
                            <a onclick="event.stopPropagation(); openAuthModal('login')" class="prod-add" title="Inicia sesión para pedir" style="cursor:pointer;">+</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach

    @auth
    {{-- Barra de pedido flotante --}}
    <div id="order-bar" style="display:none; position:fixed; bottom:1.5rem; left:50%; transform:translateX(-50%);
         background:#372618; border:1px solid rgba(224,120,32,0.35);
         box-shadow:0 20px 60px rgba(0,0,0,0.5), 0 0 30px rgba(224,120,32,0.15);
         border-radius:20px; padding:1rem 1.75rem; z-index:9999;
         align-items:center; gap:1.5rem; min-width:360px;
         opacity:0; transition:opacity 0.3s ease;">
        <div>
            <div style="font-size:0.75rem; color:#8A7460; text-transform:uppercase; letter-spacing:0.5px;">Tu pedido</div>
            <div style="color:#F2E8D5; font-weight:700;">
                <span id="bar-items">0</span> item(s) ·
                <span id="bar-total" style="color:#F09040;">$0</span>
            </div>
        </div>
        <div style="display:flex; gap:0.75rem; align-items:center; margin-left:auto;">
            <button type="button" class="btn btn-primary" onclick="openCheckoutModal()" style="border:none; padding: 0.6rem 1.25rem;">Pedir 🔥</button>
        </div>
    </div>
    @endauth
</div>

@auth
{{-- ══════════════════════════════════════════════════════════
     MODAL DE CHECKOUT
══════════════════════════════════════════════════════════ --}}
<div class="auth-modal-overlay" id="checkoutModalOverlay" onclick="closeCheckoutModal()">
    <div class="auth-modal" onclick="event.stopPropagation()" style="max-width:650px; width:95%;">
        <button type="button" class="auth-modal-close" onclick="closeCheckoutModal()">×</button>
        <h2 class="auth-modal-title" style="font-size:1.8rem;">Detalles del Pedido</h2>
        <p class="auth-modal-subtitle">Revisa tus productos y personalízalos 🔥</p>

        <div style="text-align:left; max-height:60vh; overflow-y:auto; padding-right:5px; margin-bottom:1rem;" id="checkout-scroll-area">
            {{-- Contenedor dinámico de productos --}}
            <div id="checkout-items-container" style="margin-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1rem;">
                <!-- Los items se inyectarán aquí -->
            </div>
            {{-- Tipo de entrega --}}
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label">¿Cómo deseas recibir tu pedido? *</label>
                <div style="display:flex; gap:1rem;">
                    <label style="flex:1; display:flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.05); padding:0.75rem; border-radius:8px; cursor:pointer; border:1px solid rgba(255,255,255,0.1);">
                        <input type="radio" name="order_type" value="delivery" checked onchange="toggleDeliveryMode(this.value)" class="mr-radio">
                        <span style="color:#F2E8D5; font-size:0.9rem;">🛵 Domicilio</span>
                    </label>
                    <label style="flex:1; display:flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.05); padding:0.75rem; border-radius:8px; cursor:pointer; border:1px solid rgba(255,255,255,0.1);">
                        <input type="radio" name="order_type" value="pickup" onchange="toggleDeliveryMode(this.value)" class="mr-radio">
                        <span style="color:#F2E8D5; font-size:0.9rem;">🏪 Recoger en local</span>
                    </label>
                </div>
            </div>

            {{-- Dirección --}}
            <div id="address-container" class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label">Dirección de Entrega *</label>
                @if(empty($addresses) || $addresses->isEmpty())
                    <input type="text" name="new_address" id="new_address_input" class="form-input modal-input" placeholder="Ej: Calle 10 # 20-30, Apto 101">
                    <small style="color:#8A7460; font-size:0.75rem;">Guardaremos esta dirección automáticamente para tus próximos pedidos.</small>
                @else
                    <select name="address_id" id="address_id_select" required class="form-input modal-input">
                        <option value="">Selecciona dirección...</option>
                        @foreach($addresses as $addr)
                            <option value="{{ $addr->id }}">{{ $addr->address }} {{ $addr->reference ? '('.$addr->reference.')' : '' }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            {{-- Comentarios del pedido --}}
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label">Comentarios Adicionales (Opcional)</label>
                <textarea name="notes" class="form-input modal-input" rows="2" placeholder="Ej: La carne bien asada, por favor timbrar fuerte, etc."></textarea>
                <small style="color:#8A7460; font-size:0.75rem;">Usa este espacio para instrucciones de preparación generales o de entrega.</small>
            </div>

            {{-- Medio de pago --}}
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label">Medio de Pago *</label>
                <div style="display:flex; gap:1rem;">
                    <label style="flex:1; display:flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.05); padding:0.75rem; border-radius:8px; cursor:pointer; border:1px solid rgba(255,255,255,0.1);">
                        <input type="radio" name="payment_method" value="cash" checked onchange="toggleTransferInfo()" class="mr-radio">
                        <span style="color:#F2E8D5; font-size:0.9rem;">💵 Efectivo</span>
                    </label>
                    <label style="flex:1; display:flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.05); padding:0.75rem; border-radius:8px; cursor:pointer; border:1px solid rgba(255,255,255,0.1);">
                        <input type="radio" name="payment_method" value="transfer" onchange="toggleTransferInfo()" class="mr-radio">
                        <span style="color:#F2E8D5; font-size:0.9rem;">🏦 Transferencia</span>
                    </label>
                </div>
            </div>

            {{-- Info Transferencia --}}
            <div id="transfer-info" style="display:none; background:rgba(224,120,32,0.1); border:1px solid rgba(224,120,32,0.3); border-radius:8px; padding:1rem; margin-bottom:1.5rem;">
                <div style="display:flex; align-items:center; gap:1.5rem; margin-bottom:1.5rem; background:rgba(0,0,0,0.2); padding:1.25rem; border-radius:12px;">
                    <!-- QR Placeholder -->
                    <div style="width:130px; height:130px; background:#fff; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#1a1512; flex-shrink:0; box-shadow:0 4px 6px rgba(0,0,0,0.3); position:relative; padding: 4px;">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=BreB-123456789" alt="QR" style="width:100%; height:100%; object-fit:contain; border-radius:8px;">
                        <div style="position:absolute; bottom:-22px; font-size:0.7rem; color:var(--primary-light); font-weight:700; text-align:center; width:100%; letter-spacing: 0.5px;">ESCANEAME</div>
                    </div>
                    
                    <!-- Text Info -->
                    <div style="font-size:0.95rem; color:#F2E8D5; line-height:1.7;">
                        <div style="margin-bottom: 0.5rem;">
                            <span style="color:#8A7460; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Titular</span><br>
                            <strong style="color:#E07820; font-size:1.1rem;">Mr. Sabor Burgers SAS</strong>
                        </div>
                        <div>
                            <span style="color:#8A7460; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Llave BreB Bancaria</span><br>
                            <strong style="color:#fff; font-size:1.15rem; letter-spacing: 1px;">310-263-2358</strong>
                        </div>
                    </div>
                </div>
                <label class="form-label">Sube tu comprobante (Foto o Captura) *</label>
                <input type="file" name="payment_receipt" id="payment_receipt" class="form-input modal-input" accept="image/*" style="padding:0.5rem;">
                <small style="color:#8A7460; font-size:0.75rem; display:block; margin-top:0.25rem;">Requerido para confirmar. <strong style="color:#E07820;">Máximo 2MB</strong> (te sugerimos tomar captura de pantalla).</small>
            </div>
            
            <button type="submit" class="btn btn-primary btn-full" id="btn-submit-order" style="border:none; padding:1rem; font-size:1.1rem;">Confirmar y Pedir 🔥</button>
        </div>
    </div>
</div>
@endauth
</form>

{{-- ══════════════════════════════════════════════════════════
     MODAL DE PRODUCTO (INFO COMPLETA)
══════════════════════════════════════════════════════════ --}}
<div class="product-modal-overlay" id="productModalOverlay" onclick="closeProductModal()">
    <div class="product-modal" onclick="event.stopPropagation()">
        <button class="product-modal-close" onclick="closeProductModal()">×</button>
        <div class="product-modal-img-wrap">
            <img id="pm-img" class="product-modal-img" src="" alt="Producto" style="display:none;">
            <div id="pm-emoji" style="font-size: 5rem; display:none;">🍔</div>
        </div>
        <div class="product-modal-body">
            <div id="pm-title" class="product-modal-title">Nombre Producto</div>
            <div id="pm-price" class="product-modal-price">$0</div>
            <div id="pm-desc" class="product-modal-desc">Descripción detallada...</div>
        </div>
    </div>
</div>

@else
<div style="text-align:center; padding:6rem 2rem; color:#8A7460; background:var(--bg-main);">
    <div style="font-size:5rem; margin-bottom:1rem;"><i class="ph ph-fork-knife"></i></div>
    <h3 style="font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:3px; color:#F2E8D5; margin-bottom:0.5rem;">Menú en preparación</h3>
    <p>¡Muy pronto! El equipo de Mr. Sabor está listo para ti.</p>
</div>
@endif

{{-- ══════════════════════════════════════════════════════════
     SECCIÓN "NOSOTROS" / INFO DEL LOCAL
══════════════════════════════════════════════════════════ --}}
<section class="about-section" id="nosotros" style="scroll-margin-top: 80px;">
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
     MODAL DE LOGIN / REGISTRO
══════════════════════════════════════════════════════════ --}}
<div class="auth-modal-overlay" id="authModalOverlay" onclick="closeAuthModal()">
    <div class="auth-modal" onclick="event.stopPropagation()">
        <button class="auth-modal-close" onclick="closeAuthModal()">×</button>
        
        <!-- LOGIN FORM -->
        @if(session('show_login_modal'))
            <script>
                document.addEventListener('DOMContentLoaded', function() { openAuthModal('login'); });
            </script>
        @endif
        @if(session('show_register_modal'))
            <script>
                document.addEventListener('DOMContentLoaded', function() { openAuthModal('register'); });
            </script>
        @endif
        <div id="login-view">
            <h2 class="auth-modal-title">Iniciar Sesión</h2>
            <p class="auth-modal-subtitle">Entra para hacer tu pedido <i class="ph ph-fire"></i></p>
            
            @if ($errors->has('password') || ($errors->has('email') && !old('name')))
                <div style="background: rgba(220,38,38,0.1); border: 1px solid rgba(220,38,38,0.3); color: #fca5a5; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                    @if($errors->has('password'))
                        {{ $errors->first('password') }}
                    @else
                        Credenciales incorrectas.
                    @endif
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() { openAuthModal('login'); });
                </script>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-input modal-input" required autofocus>
                </div>
                <div class="form-group" style="margin-bottom: 0.5rem;">
                    <label class="form-label">Contraseña</label>
                    <div style="position: relative;">
                        <input type="password" name="password" class="form-input modal-input" style="width: 100%; padding-right: 2.5rem;" required>
                        <button type="button" class="toggle-password" tabindex="-1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #8A7460; cursor: pointer;">
                            <i class="ph ph-eye" style="font-size: 1.2rem;"></i>
                        </button>
                    </div>
                </div>
                <div style="text-align:right; margin-bottom: 1.5rem;">
                    <a onclick="toggleAuthView('forgot')" class="auth-toggle-link" style="font-size:0.8rem;">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-full" style="border:none;">Entrar</button>
            </form>
            <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem; color:#8A7460;">
                ¿No tienes cuenta? <a onclick="toggleAuthView('register')" class="auth-toggle-link">Regístrate</a>
            </p>
        </div>

        <!-- FORGOT PASSWORD FORM -->
        @if(session('status') || $errors->has('email') && !old('name') && !old('password'))
            <script>
                document.addEventListener('DOMContentLoaded', function() { openAuthModal('forgot'); });
            </script>
        @endif
        <div id="forgot-view" style="display: none;">
            <h2 class="auth-modal-title">Recuperar Contraseña</h2>
            <p class="auth-modal-subtitle">Te enviaremos un enlace a tu correo para crear una nueva contraseña.</p>

            @if (session('status'))
                <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #86efac; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem; text-align: center;">
                    @if(session('status') == 'We have emailed your password reset link.')
                        Hemos enviado el enlace de recuperación a tu correo.
                    @else
                        {{ session('status') }}
                    @endif
                </div>
            @endif

            @if ($errors->has('email') && !old('name') && !old('password'))
                <div style="background: rgba(220,38,38,0.1); border: 1px solid rgba(220,38,38,0.3); color: #fca5a5; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input modal-input" required autofocus>
                </div>
                <button type="submit" class="btn btn-primary btn-full" style="border:none;">Enviar enlace de recuperación</button>
            </form>
            <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem; color:#8A7460;">
                <a onclick="toggleAuthView('login')" class="auth-toggle-link"><i class="ph ph-arrow-left"></i> Volver a Iniciar Sesión</a>
            </p>
        </div>

        <!-- REGISTER FORM -->
        <div id="register-view" style="display: none;">
            @if(session('show_otp_step'))
                <h2 class="auth-modal-title">Código Enviado</h2>
                <p class="auth-modal-subtitle">Ingresa el código que enviamos a tu correo para verificar tu identidad.</p>
                
                @if ($errors->has('otp'))
                    <div style="background: rgba(220,38,38,0.1); border: 1px solid rgba(220,38,38,0.3); color: #fca5a5; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                        {{ $errors->first('otp') }}
                    </div>
                @endif
                <script>
                    document.addEventListener('DOMContentLoaded', function() { openAuthModal('register'); });
                </script>

                <form method="POST" action="{{ route('register.confirm') }}">
                    @csrf
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label">Código de 6 dígitos</label>
                        <input type="text" name="code" class="form-input modal-input" placeholder="000000" maxlength="6" style="text-align:center; font-size:1.5rem; letter-spacing:10px;" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" style="border:none;">Verificar y Entrar</button>
                </form>
            @else
                <h2 class="auth-modal-title">Crear Cuenta</h2>
                <p class="auth-modal-subtitle">Únete a la familia Mr. Sabor <i class="ph ph-hamburger"></i></p>

                @if ($errors->has('email_not_found'))
                    <div style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.3); color: #93c5fd; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                        {{ $errors->first('email_not_found') }}
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() { openAuthModal('register'); });
                    </script>
                @elseif ($errors->any() && old('name'))
                    <div style="background: rgba(220,38,38,0.1); border: 1px solid rgba(220,38,38,0.3); color: #fca5a5; padding: 0.75rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem;">
                        <ul style="margin: 0; padding-left: 1rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() { openAuthModal('register'); });
                    </script>
                @endif

                <form method="POST" action="{{ route('register.pre') }}">
                    @csrf
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input modal-input" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1rem;">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-input modal-input" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label">Contraseña</label>
                        <div style="position: relative;">
                            <input type="password" name="password" id="reg_password" class="form-input modal-input" style="width: 100%; padding-right: 2.5rem;" required>
                            <button type="button" class="toggle-password" tabindex="-1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #8A7460; cursor: pointer;">
                                <i class="ph ph-eye" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                        
                        <!-- Barra de fuerza -->
                        <div style="margin-top: 8px;">
                            <div style="height: 6px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden; display: flex;">
                                <div id="strength-bar" style="height: 100%; width: 0%; transition: all 0.3s ease; background: #ef4444;"></div>
                            </div>
                            <div id="strength-text" style="font-size: 0.75rem; color: #8A7460; margin-top: 4px; text-align: right;">Ingresa una contraseña</div>
                        </div>

                        <input type="hidden" name="password_confirmation" id="pass_confirm">
                    </div>
                    <button type="submit" id="reg_submit_btn" class="btn btn-primary btn-full" onclick="document.getElementById('pass_confirm').value = this.form.password.value" style="border:none; opacity:0.5; cursor:not-allowed;" disabled>Registrarse</button>
                </form>
                <p style="text-align:center; margin-top:1.5rem; font-size:0.85rem; color:#8A7460;">
                    ¿Ya tienes cuenta? <a onclick="toggleAuthView('login')" class="auth-toggle-link">Inicia Sesión</a>
                </p>
            @endif
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════════════════ --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passInput = document.getElementById('reg_password');
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    const submitBtn = document.getElementById('reg_submit_btn');

    if(passInput) {
        passInput.addEventListener('input', function() {
            const val = passInput.value;
            let score = 0;
            
            if (val.length > 0) {
                if (val.length >= 8) score += 25; // Requisito mínimo
                if (val.match(/[A-Z]/)) score += 25;
                if (val.match(/[0-9]/)) score += 25;
                if (val.match(/[^A-Za-z0-9]/)) score += 25;
            }

            if (val.length === 0) {
                strengthBar.style.width = '0%';
                strengthText.textContent = 'Ingresa una contraseña';
                strengthText.style.color = '#8A7460';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            } else if (val.length < 8) {
                // Siempre rojo si es menor de 8 porque Laravel la rechazará
                strengthBar.style.width = '33%';
                strengthBar.style.background = '#ef4444'; 
                strengthText.textContent = 'Débil (Mínimo 8 caracteres)';
                strengthText.style.color = '#ef4444';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            } else if (score < 75) {
                strengthBar.style.width = '66%';
                strengthBar.style.background = '#eab308'; 
                strengthText.textContent = 'Media (Puedes mejorarla)';
                strengthText.style.color = '#eab308';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            } else {
                strengthBar.style.width = '100%';
                strengthBar.style.background = '#22c55e'; 
                strengthText.textContent = '¡Excelente y segura!';
                strengthText.style.color = '#22c55e';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        });
    }

    // Toggle Eye icon global
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ph-eye');
                icon.classList.add('ph-eye-slash');
                icon.style.color = '#E07820';
            } else {
                input.type = 'password';
                icon.classList.remove('ph-eye-slash');
                icon.classList.add('ph-eye');
                icon.style.color = '#8A7460';
            }
        });
    });
});
</script>
<script>
let isModalOpen = false;

// ── Modal Auth ────────────────────────────────────────────
function toggleTransferInfo() {
    const val = document.querySelector('input[name="payment_method"]:checked').value;
    document.getElementById('transfer-info').style.display = (val === 'transfer') ? 'block' : 'none';
    if (val !== 'transfer') document.getElementById('payment_receipt').value = '';
}

function openAuthModal(view = 'login') {
    isModalOpen = true;
    toggleAuthView(view);
    document.getElementById('authModalOverlay').classList.add('active');
    if(typeof recalc === 'function') recalc();
}
function closeAuthModal() {
    isModalOpen = false;
    document.getElementById('authModalOverlay').classList.remove('active');
    if(typeof recalc === 'function') recalc();
}
function toggleAuthView(view) {
    document.getElementById('login-view').style.display = view === 'login' ? 'block' : 'none';
    document.getElementById('register-view').style.display = view === 'register' ? 'block' : 'none';
    const forgotView = document.getElementById('forgot-view');
    if (forgotView) forgotView.style.display = view === 'forgot' ? 'block' : 'none';
}

// ── Cart Logic ────────────────────────────────────────────
@auth
const prices = {
    @foreach($menuItems->flatten() as $item)
    {{ $item->id }}: {{ (float)$item->price }},
    @endforeach
};

const menuData = {
    @foreach($menuItems->flatten() as $item)
    {{ $item->id }}: {
        name: "{{ addslashes($item->name) }}",
        price: {{ (float)$item->price }},
        custom: {!! json_encode($item->customizations) ?: 'null' !!}
    },
    @endforeach
};

const deliveryFee = {{ isset($deliveryFee) ? (float)$deliveryFee : 0 }};
let qtys = {};
try {
    const savedCart = sessionStorage.getItem('mrsabor_cart');
    if (savedCart) qtys = JSON.parse(savedCart);
} catch (e) {}
let totalItems = 0, totalPriceBase = 0;
let deliveryMode = 'delivery';

function changeQty(id, delta) {
    qtys[id] = Math.max(0, (qtys[id] || 0) + delta);
    document.getElementById('qty-display-' + id).textContent = qtys[id];

    if (delta > 0) {
        // Registrar interés (vista) en el producto
        fetch(`/api/menu-items/${id}/view`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).catch(err => console.log('Error tracking view', err));
    }

    // highlight card
    const card = document.querySelector(`.prod-card[data-id="${id}"]`);
    if (card) {
        if (qtys[id] > 0) {
            card.style.borderColor = 'rgba(224,120,32,0.45)';
            card.style.background  = 'rgba(224,120,32,0.05)';
        } else {
            card.style.borderColor = '';
            card.style.background  = '';
        }
    }

    try { sessionStorage.setItem('mrsabor_cart', JSON.stringify(qtys)); } catch(e) {}
    recalc();
}

function initCartUI() {
    for (const [id, q] of Object.entries(qtys)) {
        if (q > 0) {
            const display = document.getElementById('qty-display-' + id);
            if (display) display.textContent = q;
            
            const card = document.querySelector(`.prod-card[data-id="${id}"]`);
            if (card) {
                card.style.borderColor = 'rgba(224,120,32,0.45)';
                card.style.background  = 'rgba(224,120,32,0.05)';
            }
        }
    }
    recalc();
}
document.addEventListener('DOMContentLoaded', initCartUI);

function recalc() {
    totalItems = 0; totalPriceBase = 0;
    
    for (const [id, q] of Object.entries(qtys)) {
        if (q > 0 && prices[id]) { 
            totalItems += q; 
            totalPriceBase += prices[id] * q; 
        }
    }

    let barTotal = totalPriceBase;
    if (totalItems > 0 && deliveryMode === 'delivery') barTotal += deliveryFee;

    const bar = document.getElementById('order-bar');
    if (bar) {
        document.getElementById('bar-items').textContent = totalItems;
        const fmt = barTotal >= 1000 ? '$' + (barTotal/1000).toFixed(1) + 'K' : '$' + barTotal.toFixed(0);
        document.getElementById('bar-total').textContent = deliveryMode === 'delivery' ? fmt + ' (Inc. Domicilio)' : fmt;

        const navBadge = document.getElementById('nav-cart-badge');
        if (navBadge) {
            if (totalItems > 0) {
                navBadge.textContent = totalItems;
                navBadge.style.display = 'flex';
            } else {
                navBadge.style.display = 'none';
            }
        }

        if (totalItems > 0 && !isModalOpen) {
            bar.style.display = 'flex';
            setTimeout(() => bar.style.opacity = '1', 10);
        } else {
            bar.style.opacity = '0';
            setTimeout(() => bar.style.display = 'none', 300);
        }
    }
}

function openCheckoutModal() {
    isModalOpen = true;
    recalc();
    const container = document.getElementById('checkout-items-container');
    container.innerHTML = '';
    
    let html = '';
    let itemIndex = 0;

    for (const [id, q] of Object.entries(qtys)) {
        if (q > 0 && menuData[id]) {
            const product = menuData[id];
            
            for(let i=0; i<q; i++) {
                html += `
                    <div class="checkout-cart-item" id="checkout-item-${itemIndex}" data-id="${id}" data-index="${itemIndex}" style="margin-bottom:1rem; padding:1rem; background:rgba(0,0,0,0.2); border-radius:8px; border:1px solid rgba(224,120,32,0.2);">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.5rem;">
                            <span style="font-weight:700; color:#F2E8D5; max-width:80%; line-height:1.2;">${product.name}</span>
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <span style="color:#E07820; font-weight:700;">$${(product.price / 1000).toFixed(1)}K</span>
                                <button type="button" onclick="removeCheckoutItem('${id}', ${itemIndex})" style="background:none; border:none; color:#ef4444; cursor:pointer; padding:0; display:flex; align-items:center;" title="Eliminar producto">
                                    <i class="ph ph-trash" style="font-size:1.2rem; opacity:0.8; transition:0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'"></i>
                                </button>
                            </div>
                        </div>
                `;
                
                if (product.custom && ((product.custom.removable && product.custom.removable.length) || (product.custom.extras && product.custom.extras.length))) {
                    
                    if (product.custom.removable && product.custom.removable.length) {
                        html += `<div style="margin-top:0.5rem;"><div style="font-size:0.75rem; color:#8A7460; margin-bottom:0.2rem; text-transform:uppercase;">Quitar:</div>`;
                        product.custom.removable.forEach(rem => {
                            html += `
                                <label style="display:inline-flex; align-items:center; gap:0.4rem; margin-right:1rem; color:#F2E8D5; font-size:0.85rem; cursor:pointer;">
                                    <input type="checkbox" class="chk-removable mr-checkbox" data-item="${itemIndex}" value="${rem}">
                                    <span>${rem}</span>
                                </label>
                            `;
                        });
                        html += `</div>`;
                    }
                    
                    if (product.custom.extras && product.custom.extras.length) {
                        html += `<div style="margin-top:0.5rem;"><div style="font-size:0.75rem; color:#8A7460; margin-bottom:0.2rem; text-transform:uppercase;">Adiciones:</div>`;
                        product.custom.extras.forEach(ext => {
                            html += `
                                <label style="display:flex; align-items:center; gap:0.5rem; color:#F2E8D5; font-size:0.85rem; cursor:pointer; margin-bottom:0.4rem;">
                                    <input type="checkbox" class="chk-extra mr-checkbox" data-item="${itemIndex}" data-price="${ext.price}" data-name="${ext.name}" onchange="updateCheckoutTotal()">
                                    <span>${ext.name} <strong style="color:var(--primary-light); font-weight:600;">(+$${ext.price})</strong></span>
                                </label>
                            `;
                        });
                        html += `</div>`;
                    }
                }
                
                html += `</div>`;
                itemIndex++;
            }
        }
    }
    
    container.innerHTML = html;
    updateCheckoutTotal();
    
    // El carrito ya no se limpia aquí para evitar que se pierda si falla la validación del backend.
    // Se limpiará en la página de mis-pedidos cuando la orden se cree exitosamente.
    
    document.getElementById('checkoutModalOverlay').classList.add('active');
}

function removeCheckoutItem(id, itemIndex) {
    if (qtys[id] > 0) {
        qtys[id]--;
        
        const display = document.getElementById('qty-display-' + id);
        if (display) display.textContent = qtys[id];
        
        if (qtys[id] === 0) {
            const card = document.querySelector(`.prod-card[data-id="${id}"]`);
            if (card) {
                card.style.borderColor = '';
                card.style.background  = '';
            }
        }
        
        try { sessionStorage.setItem('mrsabor_cart', JSON.stringify(qtys)); } catch(e) {}
        
        recalc();
        
        const itemElement = document.getElementById('checkout-item-' + itemIndex);
        if (itemElement) {
            itemElement.style.transition = 'opacity 0.3s ease';
            itemElement.style.opacity = '0';
            setTimeout(() => {
                itemElement.remove();
                updateCheckoutTotal();
                if (totalItems === 0) {
                    closeCheckoutModal();
                }
            }, 300);
        }
    }
}

function updateCheckoutTotal() {
    let finalTotal = totalPriceBase;
    if (deliveryMode === 'delivery') {
        finalTotal += deliveryFee;
    }
    
    document.querySelectorAll('.chk-extra:checked').forEach(chk => {
        finalTotal += parseFloat(chk.dataset.price);
    });
    
    const btn = document.getElementById('btn-submit-order');
    const fmt = finalTotal >= 1000 ? '$' + (finalTotal/1000).toFixed(1) + 'K' : '$' + finalTotal.toFixed(0);
    btn.innerHTML = `Confirmar y Pedir - ${fmt} 🔥`;
}

function toggleTransferInfo() {
    const isTransfer = document.querySelector('input[name="payment_method"][value="transfer"]').checked;
    document.getElementById('transfer-info').style.display = isTransfer ? 'block' : 'none';
    document.getElementById('payment_receipt').required = isTransfer;
}

function toggleDeliveryMode(mode) {
    deliveryMode = mode;
    const addrContainer = document.getElementById('address-container');
    const newInput = document.getElementById('new_address_input');
    const select = document.getElementById('address_id_select');

    if (mode === 'pickup') {
        addrContainer.style.display = 'none';
        if (newInput) newInput.removeAttribute('required');
        if (select) select.removeAttribute('required');
    } else {
        addrContainer.style.display = 'block';
        if (newInput) newInput.setAttribute('required', 'true');
        if (select) select.setAttribute('required', 'true');
    }
    
    // Update totals
    recalc();
    updateCheckoutTotal();
}

function closeCheckoutModal() {
    isModalOpen = false;
    document.getElementById('checkoutModalOverlay').classList.remove('active');
    recalc();
}

document.getElementById('order-form')?.addEventListener('submit', function(e) {
    let addressSelect = document.querySelector('select[name="address_id"]');
    let newAddressInput = document.querySelector('input[name="new_address"]');
    
    if (deliveryMode === 'delivery') {
        if (addressSelect && !addressSelect.value) {
            e.preventDefault();
            alert('Por favor selecciona una dirección de entrega.');
            return false;
        }
        
        if (newAddressInput && !newAddressInput.value.trim()) {
            e.preventDefault();
            alert('Por favor escribe una dirección de entrega.');
            return false;
        }
    }

    let pm = document.querySelector('input[name="payment_method"]:checked')?.value;
    if (pm === 'transfer') {
        let fileInput = document.getElementById('payment_receipt');
        if (fileInput.files.length === 0) {
            e.preventDefault();
            alert('Debes adjuntar el comprobante de transferencia para continuar.');
            return false;
        }
        
        // Validación de tamaño de archivo (Max 2MB para evitar errores de servidor)
        let file = fileInput.files[0];
        if (file && file.size > 2 * 1024 * 1024) {
            e.preventDefault();
            alert('¡El comprobante es muy pesado! Tu foto pesa más de 2MB.\n\nPor favor, toma una captura de pantalla al comprobante y sube la captura (pesan mucho menos).');
            return false;
        }
    }
    
    // Evitar múltiples envíos
    const submitBtn = document.getElementById('btn-submit-order');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Procesando... <i class="ph ph-spinner ph-spin"></i>';
    }

    if (totalItems === 0) {
        e.preventDefault();
        alert('Tu carrito está vacío.');
        return false;
    }

    // Generar inputs ocultos para cada item configurado
    const form = this;
    document.querySelectorAll('.dynamic-cart-input').forEach(el => el.remove());

    const items = document.querySelectorAll('.checkout-cart-item');
    items.forEach((itemDiv, index) => {
        const id = itemDiv.dataset.id;
        const itemIdx = itemDiv.dataset.index;
        
        let idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = `items[${index}][id]`;
        idInput.value = id;
        idInput.className = 'dynamic-cart-input';
        form.appendChild(idInput);

        let qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = `items[${index}][quantity]`;
        qtyInput.value = 1; // cada bloque es 1 unidad
        qtyInput.className = 'dynamic-cart-input';
        form.appendChild(qtyInput);

        let removed = [];
        itemDiv.querySelectorAll('.chk-removable:checked').forEach(chk => {
            removed.push(chk.value);
        });
        
        let added = [];
        itemDiv.querySelectorAll('.chk-extra:checked').forEach(chk => {
            added.push({ name: chk.dataset.name, price: parseFloat(chk.dataset.price) });
        });
        
        if (removed.length > 0 || added.length > 0) {
            let custInput = document.createElement('input');
            custInput.type = 'hidden';
            custInput.name = `items[${index}][customizations]`;
            custInput.value = JSON.stringify({ removed: removed, extras: added });
            custInput.className = 'dynamic-cart-input';
            form.appendChild(custInput);
        }
    });
});
@endauth

// ── Navbar scroll effect ──────────────────────────────────
window.addEventListener('scroll', () => {
    document.getElementById('lp-nav').classList.toggle('scrolled', window.scrollY > 30);
});

// ── Modal de Producto ─────────────────────────────────────
function openProductModal(el) {
    const name  = el.dataset.name;
    const desc  = el.dataset.desc;
    const price = el.dataset.price;
    const img   = el.dataset.img;
    const emoji = el.dataset.emoji.trim();

    document.getElementById('pm-title').innerText = name;
    document.getElementById('pm-price').innerText = price;
    document.getElementById('pm-desc').innerText  = desc;

    if (img) {
        document.getElementById('pm-img').src = img;
        document.getElementById('pm-img').style.display = 'block';
        document.getElementById('pm-emoji').style.display = 'none';
    } else {
        document.getElementById('pm-emoji').innerText = emoji;
        document.getElementById('pm-img').style.display = 'none';
        document.getElementById('pm-emoji').style.display = 'block';
    }

    document.getElementById('productModalOverlay').classList.add('active');
}
function closeProductModal() {
    document.getElementById('productModalOverlay').classList.remove('active');
}

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

// ── Scroll Suave General (Navbar) ───────────
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        if (this.classList.contains('cat-pill')) return;
        
        let targetId = this.getAttribute('href');
        
        // Si quieren ir al menú, los llevamos directamente a la primera categoría (Hamburguesas)
        if (targetId === '#menu') {
            const firstPill = document.querySelector('.cat-pill');
            if (firstPill) {
                targetId = '#cat-' + firstPill.dataset.cat;
            }
        }
        
        if (targetId && targetId.length > 1 && targetId.startsWith('#')) {
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                // 70px (nav) + 60px (barra de categorías) = 130px de offset para que no se tape
                const headerOffset = 130; 
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        }
    });
});
</script>

@if ($errors->any() && !old('email'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorMsg = {!! json_encode(implode('\n', $errors->all())) !!};
        alert('Hubo un problema al procesar tu pedido:\n' + errorMsg);
        
        // Si hay carrito, abrimos el modal de nuevo para que intenten
        setTimeout(() => {
            if (Object.keys(qtys || {}).length > 0) {
                openCheckoutModal();
            }
        }, 500);
    });
</script>
@endif

@if (session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert({!! json_encode(session('error')) !!});
    });
</script>
@endif

</body>
</html>
