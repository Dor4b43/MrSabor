@extends('layouts.admin')
@section('page-title', 'Nuevo Producto')
@section('page-subtitle', 'Añade un nuevo item al menú')
@section('topbar-actions')
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

<div class="admin-card" style="max-width:700px;">
    <div class="admin-card-header">
        <span class="admin-card-title">➕ Crear nuevo producto</span>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.menu-items.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="name">Nombre del producto *</label>
                    <input id="name" name="name" type="text" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name') }}" required placeholder="Ej: Burger Clásica">
                    @error('name')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="form-label" for="price">Precio (COP) *</label>
                    <input id="price" name="price" type="number" step="100" min="0" class="form-input {{ $errors->has('price') ? 'is-invalid' : '' }}"
                        value="{{ old('price') }}" required placeholder="Ej: 14900">
                    @error('price')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3" class="form-input {{ $errors->has('description') ? 'is-invalid' : '' }}"
                    placeholder="Ingredientes y descripción del producto...">{{ old('description') }}</textarea>
                @error('description')<p class="form-error">⚠️ {{ $message }}</p>@enderror
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="category_id">Categoría *</label>
                    <select id="category_id" name="category_id" class="form-input {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="form-label">¿Disponible?</label>
                    <label class="form-check" style="margin-top:0.75rem;">
                        <input type="checkbox" name="is_available" value="1" class="form-check-input"
                            {{ old('is_available', 1) ? 'checked' : '' }}>
                        <span class="form-check-label">Sí, mostrar en el menú</span>
                    </label>
                </div>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="removable_ingredients">Ingredientes que se pueden quitar (Opcional)</label>
                    <textarea id="removable_ingredients" name="removable_ingredients" rows="3" class="form-input"
                        placeholder="Ej:&#10;Cebolla&#10;Salsas&#10;Tomate">{{ old('removable_ingredients') }}</textarea>
                    <small style="color:var(--text-muted); font-size:0.75rem;">Un ingrediente por línea.</small>
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="extra_ingredients">Adiciones con costo (Opcional)</label>
                    <textarea id="extra_ingredients" name="extra_ingredients" rows="3" class="form-input"
                        placeholder="Ej:&#10;Tocineta | 3000&#10;Queso | 2000">{{ old('extra_ingredients') }}</textarea>
                    <small style="color:var(--text-muted); font-size:0.75rem;">Formato: Nombre | Precio. Uno por línea.</small>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="image">Imagen del producto</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    onchange="previewImage(this)">
                <p style="font-size:0.75rem; color:var(--text-muted); margin-top:0.35rem;">JPG, PNG o WebP · máx. 3 MB</p>
                @error('image')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                <div id="img-preview-wrap" style="margin-top:0.75rem; display:none;">
                    <img id="img-preview" class="img-preview" src="" alt="Vista previa" style="width:120px; height:120px;">
                    <div style="margin-top:0.5rem;">
                        <button type="button" id="ai-btn" class="btn btn-primary btn-sm" onclick="triggerAI()" style="background: linear-gradient(45deg, #E07820, #9C27B0); border:none; display:none; gap:0.5rem;">
                            <i class="ph ph-magic-wand"></i> Autocompletar con IA
                        </button>
                    </div>
                </div>
            </div>

            <div style="display:flex; gap:0.75rem; margin-top:0.5rem;">
                <button type="submit" class="btn btn-primary">✅ Crear producto</button>
                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
let currentBase64 = null;

function previewImage(input) {
    const wrap = document.getElementById('img-preview-wrap');
    const img  = document.getElementById('img-preview');
    const aiBtn = document.getElementById('ai-btn');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { 
            currentBase64 = e.target.result;
            img.src = currentBase64; 
            wrap.style.display = 'block'; 
            aiBtn.style.display = 'inline-flex';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        wrap.style.display = 'none';
        aiBtn.style.display = 'none';
        currentBase64 = null;
    }
}

function triggerAI() {
    if (currentBase64) {
        analyzeImageWithAI(currentBase64);
    }
}

async function analyzeImageWithAI(base64Image) {
    const apiKey = "AIzaSyDsFUNKo2O2tgywBvR_B5lRVfL78k4kXis";
    const url = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=${apiKey}`;

    const prompt = `Analiza esta imagen de comida para un restaurante de comida rápida (hamburguesas, perros, salchipapas, etc.).
Devuelve ÚNICAMENTE un JSON válido con la siguiente estructura:
{
  "description": "Una descripción apetitosa y comercial de 2 a 3 líneas resaltando los ingredientes visibles en la foto.",
  "removable": ["Cebolla", "Salsas"], // Máximo 4 ingredientes visibles que un cliente podría querer quitar.
  "extras": [
    {"name": "Tocineta", "price": 3000}, // Adiciones lógicas que combinan bien (ej. Tocineta, Queso Extra). Precios realistas en COP (2000-6000).
    {"name": "Doble Carne", "price": 6000}
  ]
}`;

    const base64Data = base64Image.split(',')[1];
    const mimeType = base64Image.split(';')[0].split(':')[1];

    const payload = {
        contents: [{
            parts: [
                { text: prompt },
                { inlineData: { mimeType: mimeType, data: base64Data } }
            ]
        }],
        generationConfig: {
            temperature: 0.4,
            responseMimeType: "application/json"
        }
    };

    const btn = document.getElementById('ai-btn');
    const oldHtml = btn.innerHTML;
    const oldStyle = btn.style.background;
    
    try {
        btn.innerHTML = '<i class="ph ph-spinner ph-spin"></i> Analizando imagen...';
        btn.style.background = '#333';
        btn.disabled = true;

        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        
        if (!response.ok) throw new Error('Network response was not ok');
        
        const data = await response.json();
        const textResponse = data.candidates[0].content.parts[0].text;
        const result = JSON.parse(textResponse);
        
        if (result.description) {
            document.getElementById('description').value = result.description;
        }
        if (result.removable && result.removable.length) {
            document.getElementById('removable_ingredients').value = result.removable.join('\n');
        }
        if (result.extras && result.extras.length) {
            document.getElementById('extra_ingredients').value = result.extras.map(e => `${e.name} | ${e.price}`).join('\n');
        }

        btn.innerHTML = '<i class="ph ph-check-circle"></i> ¡Rellenado por IA!';
        btn.style.background = '#10b981';
        
        setTimeout(() => {
            btn.innerHTML = oldHtml;
            btn.style.background = oldStyle;
            btn.disabled = false;
        }, 3000);

    } catch (e) {
        console.error("AI Error:", e);
        alert('Hubo un error al procesar la imagen con IA. Intenta de nuevo.');
        btn.innerHTML = oldHtml;
        btn.style.background = oldStyle;
        btn.disabled = false;
    }
}
</script>

@endsection
