<x-app-layout>
<div class="dashboard-content" style="max-width:720px;">

    {{-- Header --}}
    <div class="welcome-card" style="margin-bottom:2rem;">
        <div class="welcome-avatar">👤</div>
        <div class="welcome-text">
            <h2>Mi Perfil</h2>
            <p>Gestiona tu información personal y contraseña.</p>
        </div>
    </div>

    {{-- Info personal --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <span class="admin-card-title">📝 Información de la cuenta</span>
        </div>
        <div class="admin-card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('patch')

                <div class="admin-form-row" style="margin-bottom:1.25rem;">
                    <div class="admin-form-group">
                        <label class="form-label" for="name">Nombre completo</label>
                        <input id="name" name="name" type="text" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name', $user->name) }}" required autocomplete="name">
                        @error('name')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                    </div>
                    <div class="admin-form-group">
                        <label class="form-label" for="email">Correo electrónico</label>
                        <input id="email" name="email" type="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email', $user->email) }}" required autocomplete="username">
                        @error('email')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                    </div>
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div style="padding:0.875rem; background:rgba(200,144,42,0.1); border:1px solid rgba(200,144,42,0.2); border-radius:10px; margin-bottom:1rem;">
                        <p style="font-size:0.85rem; color:#e8b84a;">⚠️ Tu email no está verificado.
                            <form method="POST" action="{{ route('verification.send') }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none; border:none; color:var(--primary-light); cursor:pointer; text-decoration:underline; font-size:0.85rem; padding:0;">Reenviar verificación</button>
                            </form>
                        </p>
                    </div>
                @endif

                <div style="display:flex; align-items:center; gap:1rem;">
                    <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
                    @if (session('status') === 'profile-updated')
                        <span style="color:#86efac; font-size:0.85rem; animation: fadeIn 0.5s ease;">✅ ¡Guardado!</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Mis Direcciones --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <span class="admin-card-title">📍 Mis Direcciones</span>
        </div>
        <div class="admin-card-body">
            @if(session('success'))
                <div style="color:#86efac; font-size:0.85rem; margin-bottom:1rem;">✅ {{ session('success') }}</div>
            @endif

            @if(auth()->user()->addresses && auth()->user()->addresses->count() > 0)
                <div style="margin-bottom:1.5rem; display:grid; gap:0.75rem;">
                    @foreach(auth()->user()->addresses as $addr)
                        <div style="display:flex; justify-content:space-between; align-items:center; background:rgba(255,255,255,0.03); border:1px solid var(--border); padding:1rem; border-radius:10px;">
                            <div>
                                <h4 style="color:var(--text-light); margin:0;">{{ $addr->address }}</h4>
                                @if($addr->reference)
                                    <p style="color:var(--text-muted); font-size:0.8rem; margin:0.25rem 0 0;">Nota: {{ $addr->reference }}</p>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('addresses.destroy', $addr) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="color:#f87171; border:none; background:none; cursor:pointer;" onclick="return confirm('¿Eliminar esta dirección?')">🗑️ Eliminar</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('addresses.store') }}" style="background:rgba(255,255,255,0.02); padding:1rem; border-radius:10px; border:1px dashed var(--border);">
                @csrf
                <h4 style="font-size:0.9rem; color:var(--text-light); margin-bottom:1rem;">Añadir nueva dirección</h4>
                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label class="form-label" for="address">Dirección de entrega (Ej: Calle 45 #12-34)</label>
                        <input id="address" name="address" type="text" class="form-input" required placeholder="Tu dirección completa">
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label class="form-label" for="reference">Referencia o Barrio (Opcional)</label>
                        <input id="reference" name="reference" type="text" class="form-input" placeholder="Ej: Casa esquinera verde, Barrio Centro">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">➕ Guardar dirección</button>
            </form>
        </div>
    </div>

    {{-- Contraseña --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <span class="admin-card-title">🔑 Cambiar contraseña</span>
        </div>
        <div class="admin-card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf @method('put')

                <div class="admin-form-group">
                    <label class="form-label" for="update_password_current_password">Contraseña actual</label>
                    <input id="update_password_current_password" name="current_password" type="password"
                        class="form-input {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}"
                        placeholder="Tu contraseña actual" autocomplete="current-password">
                    @if($errors->updatePassword->has('current_password'))
                        <p class="form-error">⚠️ {{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label class="form-label" for="update_password_password">Nueva contraseña</label>
                        <input id="update_password_password" name="password" type="password"
                            class="form-input {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"
                            placeholder="Nueva contraseña" autocomplete="new-password">
                        @if($errors->updatePassword->has('password'))
                            <p class="form-error">⚠️ {{ $errors->updatePassword->first('password') }}</p>
                        @endif
                    </div>
                    <div class="admin-form-group">
                        <label class="form-label" for="update_password_password_confirmation">Confirmar contraseña</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="form-input" placeholder="Confirmar nueva contraseña" autocomplete="new-password">
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:1rem;">
                    <button type="submit" class="btn btn-primary">🔐 Actualizar contraseña</button>
                    @if (session('status') === 'password-updated')
                        <span style="color:#86efac; font-size:0.85rem;">✅ ¡Contraseña actualizada!</span>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Eliminar cuenta --}}
    <div class="admin-card" style="border-color:rgba(224,82,82,0.2);">
        <div class="admin-card-header">
            <span class="admin-card-title" style="color:#f87171;">⚠️ Zona de peligro</span>
        </div>
        <div class="admin-card-body">
            <p style="font-size:0.875rem; color:var(--text-muted); margin-bottom:1.25rem;">
                Una vez que elimines tu cuenta, todos tus datos serán eliminados permanentemente. Esta acción no se puede deshacer.
            </p>
            <button type="button" class="btn btn-sm"
                style="background:rgba(224,82,82,0.12); color:#f87171; border:1px solid rgba(224,82,82,0.25);"
                onclick="document.getElementById('delete-modal').style.display='flex'">
                🗑️ Eliminar mi cuenta
            </button>
        </div>
    </div>

    {{-- Modal eliminación --}}
    <div id="delete-modal"
         style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.75); z-index:1000; align-items:center; justify-content:center; padding:1rem;">
        <div style="background:var(--bg-card); border:1px solid rgba(224,82,82,0.3); border-radius:var(--radius); padding:2rem; max-width:420px; width:100%;">
            <h3 style="font-size:1.1rem; font-weight:700; color:#f87171; margin-bottom:0.75rem;">⚠️ ¿Eliminar cuenta?</h3>
            <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.25rem;">
                Esta acción es irreversible. Escribe tu contraseña para confirmar.
            </p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf @method('delete')
                <div class="admin-form-group">
                    <label class="form-label" for="del-password">Contraseña</label>
                    <input id="del-password" name="password" type="password" class="form-input
                        {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Tu contraseña actual">
                    @if($errors->userDeletion->has('password'))
                        <p class="form-error">⚠️ {{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>
                <div style="display:flex; gap:0.75rem; justify-content:flex-end; margin-top:1rem;">
                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('delete-modal').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-sm" style="background:rgba(224,82,82,0.15); color:#f87171; border:1px solid rgba(224,82,82,0.3);">
                        Sí, eliminar cuenta
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
</x-app-layout>
