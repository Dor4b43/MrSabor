<x-app-layout>

<style>
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .profile-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255,165,0,0.2);
    }

    .profile-avatar-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, #E07820 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 25px rgba(255,165,0,0.3);
    }

    .profile-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0 0 0.25rem 0;
        letter-spacing: 1px;
    }

    .profile-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin: 0;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 850px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    .profile-card {
        background: rgba(25, 20, 18, 0.6);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        transition: transform 0.3s ease, border-color 0.3s ease;
    }
    
    .profile-card:hover {
        border-color: rgba(255,165,0,0.15);
    }

    .card-header-flex {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .card-icon {
        color: var(--primary);
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .input-group {
        margin-bottom: 1.25rem;
    }

    .input-label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #a89f91;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .stylish-input {
        width: 100%;
        background: rgba(0,0,0,0.4);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        padding: 0.85rem 1rem;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .stylish-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255,165,0,0.15);
    }

    .action-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .btn-save {
        background: linear-gradient(135deg, var(--primary) 0%, #d96f1b 100%);
        color: #fff;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,165,0,0.3);
    }

    .btn-danger {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        text-align: center;
    }

    .btn-danger:hover {
        background: rgba(239, 68, 68, 0.2);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.2);
    }

    .address-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        padding: 1rem;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        transition: border-color 0.3s;
    }

    .address-item:hover {
        border-color: rgba(255,255,255,0.15);
    }

    .add-address-box {
        border: 1px dashed rgba(255,255,255,0.15);
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
        background: rgba(0,0,0,0.2);
    }

    .success-msg {
        color: #4ade80;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        animation: fadeIn 0.5s ease;
    }

    .verified-badge {
        font-size: 0.75rem;
        background: rgba(34,197,94,0.15);
        color: #4ade80;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-weight: 600;
        border: 1px solid rgba(34,197,94,0.3);
    }

</style>

<div class="profile-container">

    {{-- Header --}}
    <div class="profile-header">
        <div class="profile-avatar-circle">
            <i class="ph ph-user"></i>
        </div>
        <div>
            <h2 class="profile-title">Mi Perfil</h2>
            <p class="profile-subtitle">Gestiona tu información personal, direcciones y seguridad.</p>
        </div>
    </div>

    <div class="profile-grid">
        
        {{-- COLUMNA IZQUIERDA --}}
        <div class="grid-col-left">
            
            {{-- Info personal --}}
            <div class="profile-card" style="margin-bottom: 2rem;">
                <div class="card-header-flex">
                    <i class="ph ph-identification-card card-icon"></i>
                    <h3 class="card-title">Datos Personales</h3>
                </div>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('patch')

                    <div class="input-group">
                        <label class="input-label" for="name">Nombre completo</label>
                        <input id="name" name="name" type="text" class="stylish-input" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        @error('name')<p style="color:#ef4444; font-size:0.8rem; margin-top:0.4rem;">{{ $message }}</p>@enderror
                    </div>

                    <div class="input-group">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.5rem;">
                            <label class="input-label" for="email" style="margin-bottom:0;">Correo electrónico</label>
                            @if ($user->hasVerifiedEmail())
                                <div class="verified-badge"><i class="ph ph-check-circle"></i> Verificado</div>
                            @endif
                        </div>
                        <input id="email" name="email" type="email" class="stylish-input"
                            value="{{ $user->email }}" readonly 
                            style="background: rgba(0,0,0,0.5); color: #6b7280; cursor: not-allowed; border-color: transparent;">
                        <p style="font-size:0.75rem; color:var(--text-muted); margin-top:0.5rem;"><i class="ph ph-lock"></i> El correo no puede modificarse por seguridad.</p>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="btn-save"><i class="ph ph-floppy-disk"></i> Guardar Cambios</button>
                        @if (session('status') === 'profile-updated')
                            <span class="success-msg"><i class="ph ph-check-circle"></i> ¡Guardado!</span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Contraseña --}}
            <div class="profile-card">
                <div class="card-header-flex">
                    <i class="ph ph-key card-icon"></i>
                    <h3 class="card-title">Seguridad y Contraseña</h3>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('put')

                    <div class="input-group">
                        <label class="input-label" for="update_password_current_password">Contraseña actual</label>
                        <input id="update_password_current_password" name="current_password" type="password" class="stylish-input" placeholder="••••••••" autocomplete="current-password">
                        @if($errors->updatePassword->has('current_password'))
                            <p style="color:#ef4444; font-size:0.8rem; margin-top:0.4rem;">{{ $errors->updatePassword->first('current_password') }}</p>
                        @endif
                    </div>

                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="input-group">
                            <label class="input-label" for="update_password_password">Nueva contraseña</label>
                            <input id="update_password_password" name="password" type="password" class="stylish-input" placeholder="••••••••" autocomplete="new-password">
                            @if($errors->updatePassword->has('password'))
                                <p style="color:#ef4444; font-size:0.8rem; margin-top:0.4rem;">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>
                        <div class="input-group">
                            <label class="input-label" for="update_password_password_confirmation">Confirmar nueva</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="stylish-input" placeholder="••••••••" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="action-row">
                        <button type="submit" class="btn-save"><i class="ph ph-shield-check"></i> Actualizar</button>
                        @if (session('status') === 'password-updated')
                            <span class="success-msg"><i class="ph ph-check-circle"></i> ¡Actualizada!</span>
                        @endif
                    </div>
                </form>
            </div>

        </div>

        {{-- COLUMNA DERECHA --}}
        <div class="grid-col-right">
            
            {{-- Mis Direcciones --}}
            <div class="profile-card" style="margin-bottom: 2rem;">
                <div class="card-header-flex">
                    <i class="ph ph-map-pin card-icon"></i>
                    <h3 class="card-title">Mis Direcciones</h3>
                </div>

                @if(session('success'))
                    <div class="success-msg" style="margin-bottom:1.5rem;"><i class="ph ph-check-circle"></i> {{ session('success') }}</div>
                @endif

                @if(auth()->user()->addresses && auth()->user()->addresses->count() > 0)
                    <div style="margin-bottom: 1.5rem;">
                        @foreach(auth()->user()->addresses as $addr)
                            <div class="address-item">
                                <div>
                                    <h4 style="color:#fff; margin:0 0 0.25rem 0; font-size: 0.95rem;">{{ $addr->address }}</h4>
                                    @if($addr->reference)
                                        <p style="color:#a89f91; font-size:0.8rem; margin:0;"><i class="ph ph-info"></i> {{ $addr->reference }}</p>
                                    @endif
                                </div>
                                <form method="POST" action="{{ route('addresses.destroy', $addr) }}" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="color:#ef4444; background:none; border:none; cursor:pointer; font-size: 1.25rem; padding: 0.5rem; opacity: 0.8; transition: opacity 0.2s;" onclick="return confirm('¿Eliminar esta dirección?')" title="Eliminar dirección">
                                        <i class="ph ph-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color:var(--text-muted); font-size:0.9rem; text-align:center; padding: 1rem 0;">No tienes direcciones guardadas aún.</p>
                @endif

                <div class="add-address-box">
                    <h4 style="font-size:0.9rem; color:#fff; margin:0 0 1rem 0; display:flex; align-items:center; gap:0.5rem;"><i class="ph ph-plus-circle" style="color:var(--primary);"></i> Añadir nueva dirección</h4>
                    <form method="POST" action="{{ route('addresses.store') }}">
                        @csrf
                        <div class="input-group">
                            <label class="input-label" for="address">Dirección completa</label>
                            <input id="address" name="address" type="text" class="stylish-input" required placeholder="Ej: Calle 45 #12-34">
                        </div>
                        <div class="input-group">
                            <label class="input-label" for="reference">Referencia (Opcional)</label>
                            <input id="reference" name="reference" type="text" class="stylish-input" placeholder="Ej: Casa verde, frente al parque">
                        </div>
                        <button type="submit" class="btn-save" style="width:100%; justify-content:center;"><i class="ph ph-plus"></i> Guardar Dirección</button>
                    </form>
                </div>
            </div>

            {{-- Eliminar cuenta --}}
            <div class="profile-card" style="border-color: rgba(239, 68, 68, 0.2);">
                <div class="card-header-flex">
                    <i class="ph ph-warning-circle" style="color:#ef4444; font-size:1.5rem;"></i>
                    <h3 class="card-title" style="color:#ef4444;">Zona de Peligro</h3>
                </div>
                <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:1.5rem; line-height:1.5;">
                    Eliminar tu cuenta borrará permanentemente todos tus datos, historial de pedidos y direcciones. Esta acción no se puede deshacer.
                </p>
                <button type="button" class="btn-danger" onclick="document.getElementById('delete-modal').style.display='flex'">
                    <i class="ph ph-trash"></i> Eliminar mi cuenta
                </button>
            </div>

        </div>

    </div>

    {{-- Modal eliminación --}}
    <div id="delete-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.85); backdrop-filter:blur(5px); z-index:1000; align-items:center; justify-content:center; padding:1rem;">
        <div style="background:#1a1512; border:1px solid rgba(239,68,68,0.3); border-radius:16px; padding:2.5rem; max-width:450px; width:100%; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <div style="text-align:center; margin-bottom: 1.5rem;">
                <i class="ph ph-warning" style="font-size: 3rem; color: #ef4444; margin-bottom: 0.5rem;"></i>
                <h3 style="font-size:1.5rem; font-weight:700; color:#fff; margin:0;">¿Estás completamente seguro?</h3>
            </div>
            
            <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:1.5rem; text-align:center;">
                Ingresa tu contraseña para confirmar que deseas eliminar tu cuenta permanentemente.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf @method('delete')
                <div class="input-group">
                    <input id="del-password" name="password" type="password" class="stylish-input" placeholder="Tu contraseña" style="text-align:center;">
                    @if($errors->userDeletion->has('password'))
                        <p style="color:#ef4444; font-size:0.8rem; margin-top:0.4rem; text-align:center;">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>
                <div style="display:flex; gap:1rem; margin-top:2rem;">
                    <button type="button" class="stylish-input" style="cursor:pointer; text-align:center; background:rgba(255,255,255,0.05);" onclick="document.getElementById('delete-modal').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn-danger" style="margin:0;">Sí, Eliminar</button>
                </div>
            </form>
        </div>
    </div>

</div>

</x-app-layout>
