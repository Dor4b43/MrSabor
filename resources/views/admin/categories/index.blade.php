@extends('layouts.admin')
@section('page-title', 'Categorías del Menú')
@section('page-subtitle', 'Administra las categorías de tus productos')

@section('content')
<div style="display:flex; gap:1.5rem; align-items:flex-start; flex-wrap:wrap;">

    {{-- Lista de Categorias --}}
    <div class="admin-card" style="flex:1; min-width:300px;">
        <div class="admin-card-header">
            <span class="admin-card-title">Categorías Actuales</span>
        </div>
        <div class="admin-card-body" style="padding:0;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td style="font-weight:600; color:var(--text-light);">{{ $category->name }}</td>
                        <td>
                            @if($category->status)
                                <span class="badge badge-green">Activo</span>
                            @else
                                <span class="badge badge-gray">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:0.5rem; justify-content:center;">
                                {{-- Fake edit toggle for simplicity --}}
                                <form action="{{ route('admin.categories.update', $category) }}" method="POST" style="display:inline;">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="name" value="{{ $category->name }}">
                                    <input type="hidden" name="status" value="{{ $category->status ? 0 : 1 }}">
                                    <button type="submit" class="btn btn-ghost btn-sm">
                                        {{ $category->status ? 'Ocultar' : 'Activar' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría permanentemente?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm" style="color:#f87171;">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:2rem; color:var(--text-muted);">
                            No hay categorías creadas todavía.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Crear Categoria --}}
    <div class="admin-card" style="width:340px; flex-shrink:0;">
        <div class="admin-card-header">
            <span class="admin-card-title">➕ Nueva Categoría</span>
        </div>
        <div class="admin-card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-input" required placeholder="Ej: Hamburguesas">
                </div>
                <div class="admin-form-group">
                    <label class="form-check" style="margin-top:0.75rem;">
                        <input type="checkbox" name="status" value="1" class="form-check-input" checked>
                        <span class="form-check-label">Categoría activa</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Crear Categoría</button>
            </form>
        </div>
    </div>

</div>
@endsection
