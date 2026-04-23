@extends('layouts.admin')
@section('page-title', 'Nueva Promoción')
@section('page-subtitle', 'La promoción aparecerá en el carrusel de la página principal')
@section('topbar-actions')
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

<div class="admin-card" style="max-width:700px;">
    <div class="admin-card-header">
        <span class="admin-card-title">🎉 Crear nueva promoción</span>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.promotions.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="title">Título principal *</label>
                    <input id="title" name="title" type="text" class="form-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                        value="{{ old('title') }}" required placeholder="Ej: 2x1 en Burgers">
                    @error('title')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="subtitle">Subtítulo</label>
                    <input id="subtitle" name="subtitle" type="text" class="form-input"
                        value="{{ old('subtitle') }}" placeholder="Ej: Solo hasta el domingo">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3" class="form-input"
                    placeholder="Detalles de la promoción...">{{ old('description') }}</textarea>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="badge_text">Texto del badge</label>
                    <input id="badge_text" name="badge_text" type="text" class="form-input"
                        value="{{ old('badge_text') }}" placeholder="Ej: 20% OFF · 2x1 · GRATIS">
                    <p style="font-size:0.74rem; color:var(--text-muted); margin-top:0.3rem;">Aparece resaltado sobre el título del carrusel</p>
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="sort_order">Orden en carrusel</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" class="form-input"
                        value="{{ old('sort_order', 0) }}" placeholder="0">
                    <p style="font-size:0.74rem; color:var(--text-muted); margin-top:0.3rem;">Menor número = aparece primero</p>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label">¿Mostrar en la landing?</label>
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input"
                        {{ old('is_active', 1) ? 'checked' : '' }}>
                    <span class="form-check-label">Sí, activar promoción y mostrar en el carrusel</span>
                </label>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="image">Imagen de fondo (recomendado: 1200×400px)</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input"
                    onchange="previewPromo(this)">
                <p style="font-size:0.75rem; color:var(--text-muted); margin-top:0.35rem;">JPG, PNG o WebP · máx. 4 MB. Si no subes imagen, se usa un fondo de diseño.</p>
                @error('image')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                <div id="promo-preview-wrap" style="margin-top:1rem; display:none;">
                    <div style="font-size:0.78rem; color:var(--text-muted); margin-bottom:0.4rem;">Vista previa:</div>
                    <img id="promo-preview" src="" alt="Preview"
                         style="width:100%; max-height:180px; object-fit:cover; border-radius:12px; border:1px solid var(--border);">
                </div>
            </div>

            <div style="display:flex; gap:0.75rem; margin-top:0.5rem;">
                <button type="submit" class="btn btn-primary">🎉 Crear promoción</button>
                <a href="{{ route('admin.promotions.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewPromo(input) {
    const wrap = document.getElementById('promo-preview-wrap');
    const img  = document.getElementById('promo-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
