@extends('layouts.admin')
@section('page-title', 'Editar Promoción')
@section('page-subtitle', 'Modifica «' . $promotion->title . '»')
@section('topbar-actions')
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

<div class="admin-card" style="max-width:700px;">
    <div class="admin-card-header">
        <span class="admin-card-title">✏️ Editar: {{ $promotion->title }}</span>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.promotions.update', $promotion) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="title">Título principal *</label>
                    <input id="title" name="title" type="text" class="form-input"
                        value="{{ old('title', $promotion->title) }}" required>
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="subtitle">Subtítulo</label>
                    <input id="subtitle" name="subtitle" type="text" class="form-input"
                        value="{{ old('subtitle', $promotion->subtitle) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3" class="form-input">{{ old('description', $promotion->description) }}</textarea>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="badge_text">Badge</label>
                    <input id="badge_text" name="badge_text" type="text" class="form-input"
                        value="{{ old('badge_text', $promotion->badge_text) }}" placeholder="Ej: 2x1">
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="sort_order">Orden</label>
                    <input id="sort_order" name="sort_order" type="number" min="0" class="form-input"
                        value="{{ old('sort_order', $promotion->sort_order) }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label">Estado</label>
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input"
                        {{ old('is_active', $promotion->is_active) ? 'checked' : '' }}>
                    <span class="form-check-label">Activa y visible en el carrusel</span>
                </label>
            </div>

            <div class="admin-form-group">
                <label class="form-label">Imagen actual</label>
                @if($promotion->image_path)
                    <img src="{{ Storage::url($promotion->image_path) }}" alt="{{ $promotion->title }}"
                         style="width:100%; max-height:180px; object-fit:cover; border-radius:12px; border:1px solid var(--border); margin-bottom:0.75rem;">
                @else
                    <div style="width:100%; height:80px; background:var(--bg-elevated); border:1px solid var(--border); border-radius:12px; display:flex; align-items:center; justify-content:center; color:var(--text-muted); font-size:0.85rem; margin-bottom:0.75rem;">
                        Sin imagen — se usa fondo de diseño
                    </div>
                @endif
                <label class="form-label" for="image">Cambiar imagen (opcional)</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input" onchange="previewPromo(this)">
                <div id="promo-preview-wrap" style="margin-top:0.75rem; display:none;">
                    <img id="promo-preview" src="" alt="Preview"
                         style="width:100%; max-height:180px; object-fit:cover; border-radius:12px; border:1px solid var(--border);">
                </div>
            </div>

            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
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
