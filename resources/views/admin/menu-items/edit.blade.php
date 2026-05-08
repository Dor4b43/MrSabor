@extends('layouts.admin')
@section('page-title', 'Editar Producto')
@section('page-subtitle', 'Modifica «' . $menuItem->name . '»')
@section('topbar-actions')
    <a href="{{ route('admin.menu-items.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

<div class="admin-card" style="max-width:700px;">
    <div class="admin-card-header">
        <span class="admin-card-title">✏️ Editar: {{ $menuItem->name }}</span>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.menu-items.update', $menuItem) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="name">Nombre *</label>
                    <input id="name" name="name" type="text" class="form-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name', $menuItem->name) }}" required>
                    @error('name')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div class="admin-form-group">
                    <label class="form-label" for="price">Precio (COP) *</label>
                    <input id="price" name="price" type="number" step="100" min="0" class="form-input {{ $errors->has('price') ? 'is-invalid' : '' }}"
                        value="{{ old('price', $menuItem->price) }}" required>
                    @error('price')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label" for="description">Descripción</label>
                <textarea id="description" name="description" rows="3" class="form-input">{{ old('description', $menuItem->description) }}</textarea>
            </div>

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="category_id">Categoría *</label>
                    <select id="category_id" name="category_id" class="form-input" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $menuItem->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="form-label">¿Disponible?</label>
                    <label class="form-check" style="margin-top:0.75rem;">
                        <input type="checkbox" name="is_available" value="1" class="form-check-input"
                            {{ old('is_available', $menuItem->is_available) ? 'checked' : '' }}>
                        <span class="form-check-label">Sí, mostrar en el menú</span>
                    </label>
                </div>
            </div>

            @php
                $customs = is_array($menuItem->customizations) ? $menuItem->customizations : [];
                $removables = implode("\n", $customs['removable'] ?? []);
                
                $extrasArr = [];
                foreach ($customs['extras'] ?? [] as $extra) {
                    if (isset($extra['name']) && isset($extra['price'])) {
                        $extrasArr[] = $extra['name'] . ' | ' . $extra['price'];
                    }
                }
                $extras = implode("\n", $extrasArr);
            @endphp

            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label class="form-label" for="removable_ingredients">Ingredientes que se pueden quitar (Opcional)</label>
                    <textarea id="removable_ingredients" name="removable_ingredients" rows="3" class="form-input"
                        placeholder="Ej:&#10;Cebolla&#10;Salsas&#10;Tomate">{{ old('removable_ingredients', $removables) }}</textarea>
                    <small style="color:var(--text-muted); font-size:0.75rem;">Un ingrediente por línea.</small>
                </div>
                <div class="admin-form-group">
                    <label class="form-label" for="extra_ingredients">Adiciones con costo (Opcional)</label>
                    <textarea id="extra_ingredients" name="extra_ingredients" rows="3" class="form-input"
                        placeholder="Ej:&#10;Tocineta | 3000&#10;Queso | 2000">{{ old('extra_ingredients', $extras) }}</textarea>
                    <small style="color:var(--text-muted); font-size:0.75rem;">Formato: Nombre | Precio. Uno por línea.</small>
                </div>
            </div>

            <div class="admin-form-group">
                <label class="form-label">Imagen actual</label>
                <div style="margin-bottom:0.75rem;">
                    @if($menuItem->image_url)
                        <img src="{{ $menuItem->image_url }}" class="img-preview" style="width:120px; height:120px;" alt="{{ $menuItem->name }}">
                    @else
                        <div class="img-placeholder" style="width:120px; height:120px; font-size:3rem;">🍔</div>
                    @endif
                </div>
                <label class="form-label" for="image">Cambiar imagen (opcional)</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input" onchange="previewImage(this)">
                <div id="img-preview-wrap" style="margin-top:0.75rem; display:none;">
                    <img id="img-preview" class="img-preview" src="" style="width:120px; height:120px;" alt="Nueva imagen">
                </div>
            </div>

            <div style="display:flex; gap:0.75rem; margin-top:0.5rem;">
                <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
                <a href="{{ route('admin.menu-items.index') }}" class="btn btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const wrap = document.getElementById('img-preview-wrap');
    const img  = document.getElementById('img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; wrap.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
