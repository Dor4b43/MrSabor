<x-guest-layout>
<div class="auth-wrapper">

    {{-- ═══ PANEL IZQUIERDO: HERO ═══ --}}
    <div class="auth-hero">
        <div class="auth-hero-logo">
            <x-application-logo />
            <div class="auth-hero-title-main">MR. SABOR</div>
            <div class="auth-hero-title-sub">Burgers</div>
        </div>

        <p class="auth-hero-tagline">Únete a nuestra comunidad y disfruta de los mejores sabores artesanales.</p>

        <div class="auth-hero-features">
            <div class="auth-feature-item">
                <div class="auth-feature-icon">🎉</div>
                <div class="auth-feature-text">
                    <h4>Bienvenido especial</h4>
                    <p>Descuento en tu primer pedido</p>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon">📦</div>
                <div class="auth-feature-text">
                    <h4>Historial de pedidos</h4>
                    <p>Repite tus favoritos fácilmente</p>
                </div>
            </div>
            <div class="auth-feature-item">
                <div class="auth-feature-icon">💎</div>
                <div class="auth-feature-text">
                    <h4>Puntos de fidelidad</h4>
                    <p>Acumula y canjea recompensas</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ PANEL DERECHO: FORMULARIO ═══ --}}
    <div class="auth-panel">
        <div class="auth-form-container">

            <div class="auth-form-header">
                <h2>Crea tu cuenta 🚀</h2>
                <p>Es gratis y tarda menos de un minuto</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Nombre completo</label>
                    <input id="name" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text" name="name" value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        placeholder="Tu nombre">
                    @error('name')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Correo electrónico</label>
                    <input id="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        type="email" name="email" value="{{ old('email') }}"
                        required autocomplete="username"
                        placeholder="tucorreo@ejemplo.com">
                    @error('email')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Contraseña</label>
                    <input id="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        type="password" name="password"
                        required autocomplete="new-password"
                        placeholder="Mínimo 8 caracteres">
                    @error('password')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                    <input id="password_confirmation" class="form-input {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                        type="password" name="password_confirmation"
                        required autocomplete="new-password"
                        placeholder="Repite tu contraseña">
                    @error('password_confirmation')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn btn-primary btn-full" id="btn-register" style="margin-top:0.5rem;">
                    Crear cuenta &rarr;
                </button>
            </form>

            <div class="auth-footer-link" style="margin-top:1.5rem;">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </div>

        </div>
    </div>

</div>
</x-guest-layout>
