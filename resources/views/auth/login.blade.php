<x-guest-layout>
<div class="auth-wrapper">

    {{-- ═══ PANEL IZQUIERDO: HERO ═══ --}}
    <div class="auth-hero">
        <div class="auth-hero-logo">
            <x-application-logo />
            <div class="auth-hero-title-main">MR. SABOR</div>
            <div class="auth-hero-title-sub">Burgers</div>
        </div>

        <p class="auth-hero-tagline">La comida artesanal más deliciosa de la ciudad, ahora al alcance de tus manos.</p>

        <div class="auth-hero-features">
            <div class="auth-feature-item">
                <div class="auth-feature-icon">🚀</div>
                <div class="auth-feature-text">
                    <h4>Pedidos rápidos</h4>
                    <p>Tu comida lista en minutos</p>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon">🥩</div>
                <div class="auth-feature-text">
                    <h4>Carne 100% artesanal</h4>
                    <p>Calidad garantizada siempre</p>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon">🎁</div>
                <div class="auth-feature-text">
                    <h4>Promociones exclusivas</h4>
                    <p>Ofertas solo para miembros</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ PANEL DERECHO: FORMULARIO ═══ --}}
    <div class="auth-panel">
        <div class="auth-form-container">

            <div class="auth-form-header">
                <h2>¡Bienvenido de vuelta! 👋</h2>
                <p>Inicia sesión para seguir disfrutando</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="email" name="email" value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                        placeholder="tucorreo@ejemplo.com">
                    @error('email')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password" name="password"
                        required autocomplete="current-password"
                        placeholder="••••••••">
                    @error('password')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.5rem;">
                    <label class="form-check">
                        <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
                        <span class="form-check-label">Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-full" id="btn-login">
                    Iniciar Sesión &rarr;
                </button>
            </form>

            <div class="auth-divider">
                <span>¿No tienes cuenta aún?</span>
            </div>

            <a href="{{ route('register') }}" class="btn btn-outline btn-full">
                Crear cuenta gratis
            </a>

        </div>
    </div>

</div>
</x-guest-layout>
