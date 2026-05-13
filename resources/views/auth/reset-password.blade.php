<x-app-layout>
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat; position: relative;">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(14,10,6,0.95) 0%, rgba(14,10,6,0.85) 100%); z-index: 0;"></div>
    
    <div style="position: relative; z-index: 1; background: rgba(26,21,18,0.95); border: 1px solid rgba(224,120,32,0.2); padding: 2.5rem; border-radius: 16px; width: 100%; max-width: 420px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
        
        <div style="text-align: center; margin-bottom: 2rem;">
            <i class="ph ph-fire" style="font-size: 3rem; color: var(--primary);"></i>
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #F2E8D5; margin-top: 1rem; font-family: 'Montserrat', sans-serif;">Nueva Contraseña</h2>
            <p style="color: #8A7460; font-size: 0.9rem; margin-top: 0.5rem;">Crea una nueva contraseña segura para tu cuenta.</p>
        </div>

        @if ($errors->any())
            <div style="background: rgba(220,38,38,0.1); border: 1px solid rgba(220,38,38,0.3); color: #fca5a5; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email', $request->email) }}" class="form-input modal-input" style="width: 100%;" required readonly>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Nueva Contraseña</label>
                <div style="position: relative;">
                    <input type="password" name="password" id="reset_password" class="form-input modal-input" style="width: 100%; padding-right: 2.5rem;" required autofocus>
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
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Confirmar Contraseña</label>
                <div style="position: relative;">
                    <input type="password" name="password_confirmation" id="reset_password_confirm" class="form-input modal-input" style="width: 100%; padding-right: 2.5rem;" required>
                    <button type="button" class="toggle-password" tabindex="-1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #8A7460; cursor: pointer;">
                        <i class="ph ph-eye" style="font-size: 1.2rem;"></i>
                    </button>
                </div>
                <div id="match-text" style="font-size: 0.75rem; color: #8A7460; margin-top: 6px; text-align: right; display: none;">Las contraseñas no coinciden</div>
            </div>

            <button type="submit" id="reset_submit_btn" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.8rem; font-size: 1.1rem; border: none; opacity:0.5; cursor:not-allowed;" disabled>Restablecer Contraseña</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passInput = document.getElementById('reset_password');
    const strengthBar = document.getElementById('strength-bar');
    const strengthText = document.getElementById('strength-text');
    const submitBtn = document.getElementById('reset_submit_btn');

    if(passInput) {
        passInput.addEventListener('input', function() {
            const val = passInput.value;
            let score = 0;
            
            if (val.length > 0) {
                if (val.length >= 8) score += 25;
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

    // Toggle Eye icon
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ph-eye');
                icon.classList.add('ph-eye-slash');
                icon.style.color = '#E07820'; // Highlight color when visible
            } else {
                input.type = 'password';
                icon.classList.remove('ph-eye-slash');
                icon.classList.add('ph-eye');
                icon.style.color = '#8A7460';
            }
        });
    });

    // Match validation
    const confirmInput = document.getElementById('reset_password_confirm');
    const matchText = document.getElementById('match-text');

    function checkMatch() {
        if (confirmInput.value.length === 0) {
            matchText.style.display = 'none';
            // Button is enabled/disabled strictly based on strength bar logic, but we should also restrict if no match
            checkFormValidity();
            return;
        }
        
        matchText.style.display = 'block';
        if (passInput.value === confirmInput.value) {
            matchText.textContent = '¡Las contraseñas coinciden!';
            matchText.style.color = '#22c55e';
        } else {
            matchText.textContent = 'Las contraseñas no coinciden';
            matchText.style.color = '#ef4444';
        }
        checkFormValidity();
    }

    let isStrengthValid = false;

    function checkFormValidity() {
        if (isStrengthValid && confirmInput.value.length > 0 && passInput.value === confirmInput.value) {
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
        } else {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.5';
            submitBtn.style.cursor = 'not-allowed';
        }
    }

    // Wrap the strength logic to trigger the combined check
    passInput.addEventListener('input', function() {
        const val = passInput.value;
        let score = 0;
        
        if (val.length > 0) {
            if (val.length >= 8) score += 25;
            if (val.match(/[A-Z]/)) score += 25;
            if (val.match(/[0-9]/)) score += 25;
            if (val.match(/[^A-Za-z0-9]/)) score += 25;
        }

        isStrengthValid = false;
        if (val.length === 0 || val.length < 8) {
            // ... Visual updates are handled by the other listener ...
        } else if (score >= 75) {
            isStrengthValid = true;
        } else {
            isStrengthValid = true; // Media is also valid to submit
        }
        
        checkMatch();
    });

    confirmInput.addEventListener('input', checkMatch);

});
</script>
</x-app-layout>
