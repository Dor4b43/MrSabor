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

            <div class="admin-form-group">
                <label class="form-label" for="image">Imagen del producto</label>
                <input id="image" name="image" type="file" accept="image/*" class="form-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                    onchange="previewImage(this)">
                <p style="font-size:0.75rem; color:var(--text-muted); margin-top:0.35rem;">JPG, PNG o WebP · máx. 3 MB</p>
                @error('image')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                <div id="img-preview-wrap" style="margin-top:0.75rem; display:none;">
                    <img id="img-preview" class="img-preview" src="" alt="Vista previa" style="width:120px; height:120px;">
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
