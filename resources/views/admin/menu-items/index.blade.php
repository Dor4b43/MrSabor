@extends('layouts.admin')
@section('page-title', 'Productos del Menú')
@section('page-subtitle', 'Administra todos los productos disponibles')
@section('topbar-actions')
    <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary btn-sm">➕ Nuevo producto</a>
@endsection

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <span class="admin-card-title">🍔 {{ $items->total() }} productos registrados</span>
    </div>
    <div style="overflow-x:auto;">
        @if($items->isEmpty())
            <div style="padding:3rem; text-align:center; color:var(--text-muted);">
                <div style="font-size:4rem; margin-bottom:1rem;">🍽️</div>
                <p style="font-size:1rem; margin-bottom:1.5rem;">El menú está vacío. ¡Añade tu primer producto!</p>
                <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">➕ Crear primer producto</a>
            </div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Disponible</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" class="img-preview" alt="{{ $item->name }}">
                            @else
                                <div class="img-placeholder">🍔</div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:700; color:var(--text-light);">{{ $item->name }}</div>
                            @if($item->description)
                                <div style="font-size:0.75rem; color:var(--text-muted); margin-top:0.2rem; max-width:280px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $item->description }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-amber">{{ $item->menuCategory ? $item->menuCategory->name : 'N/A' }}</span>
                        </td>
                        <td style="color:var(--primary-light); font-weight:700; font-size:1rem;">
                            {{ $item->price_formatted }}
                        </td>
                        <td>
                            @if($item->is_available)
                                <span class="badge badge-green">✅ Sí</span>
                            @else
                                <span class="badge badge-gray">❌ No</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:0.5rem;">
                                <a href="{{ route('admin.menu-items.edit', $item) }}" class="btn btn-ghost btn-sm">✏️ Editar</a>
                                <form method="POST" action="{{ route('admin.menu-items.destroy', $item) }}"
                                      onsubmit="return confirm('¿Eliminar «{{ $item->name }}»?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:rgba(224,82,82,0.12); color:#f87171; border:1px solid rgba(224,82,82,0.2);">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:1rem 1.5rem;">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
