@extends('layouts.admin')
@section('page-title', 'Promociones')
@section('page-subtitle', 'Crea y gestiona las promociones del carrusel principal')
@section('topbar-actions')
    <a href="{{ route('admin.promotions.quick-create') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#f97316,#ef4444); color:#fff; border:none; font-weight:600; box-shadow:0 2px 8px rgba(249,115,22,0.35);">⚡ Promo rápida</a>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary btn-sm">🎉 Nueva promoción</a>
@endsection

@section('content')

<div style="padding:0.875rem 1.25rem; background:rgba(224,120,32,0.07); border:1px solid rgba(224,120,32,0.15); border-radius:12px; margin-bottom:1.5rem; font-size:0.85rem; color:var(--text-mid);">
    📢 <strong>Tip:</strong> Las promociones activas se muestran automáticamente en el carrusel de la página principal. Si no hay ninguna activa, el carrusel no aparece.
</div>

<div class="admin-card">
    <div style="overflow-x:auto;">
        @if($promotions->isEmpty())
            <div style="padding:3rem 2rem; text-align:center; color:var(--text-muted);">
                <div style="font-size:4rem; margin-bottom:1rem;">🎉</div>
                <p style="font-size:1rem; margin-bottom:0.5rem; color:var(--text-mid);">No hay promociones creadas aún.</p>
                <p style="font-size:0.82rem; margin-bottom:2rem;">Crea una promoción rápida con un producto del menú o diseña una desde cero.</p>

                <div style="display:flex; flex-direction:column; align-items:center; gap:1rem;">
                    {{-- Opción destacada: Promo rápida --}}
                    <a href="{{ route('admin.promotions.quick-create') }}"
                       style="display:inline-flex; align-items:center; gap:0.6rem; padding:0.85rem 2rem;
                              background:linear-gradient(135deg,#f97316,#ef4444); color:#fff;
                              border-radius:12px; font-weight:700; font-size:1rem; text-decoration:none;
                              box-shadow:0 4px 18px rgba(249,115,22,0.4); transition:transform 0.15s, box-shadow 0.15s;"
                       onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 22px rgba(249,115,22,0.5)'"
                       onmouseout="this.style.transform='';this.style.boxShadow='0 4px 18px rgba(249,115,22,0.4)'">
                        ⚡ Crear promo rápida
                        <span style="font-size:0.72rem; background:rgba(255,255,255,0.2); padding:0.15rem 0.5rem; border-radius:20px; font-weight:600;">RECOMENDADO</span>
                    </a>

                    {{-- Separador --}}
                    <div style="display:flex; align-items:center; gap:0.75rem; width:280px;">
                        <div style="flex:1; height:1px; background:var(--border);"></div>
                        <span style="font-size:0.75rem; color:var(--text-muted);">o si prefieres</span>
                        <div style="flex:1; height:1px; background:var(--border);"></div>
                    </div>

                    {{-- Opción manual --}}
                    <a href="{{ route('admin.promotions.create') }}" class="btn btn-ghost" style="font-size:0.88rem;">
                        🎉 Crear promoción manual
                    </a>
                </div>
            </div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Badge</th>
                        <th>Orden</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promotions as $promo)
                    <tr>
                        <td>
                            @if($promo->image_path)
                                <img src="{{ Storage::url($promo->image_path) }}" class="img-preview" alt="{{ $promo->title }}">
                            @else
                                <div class="img-placeholder">🎉</div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:700; color:var(--text-light);">{{ $promo->title }}</div>
                            @if($promo->subtitle)
                                <div style="font-size:0.75rem; color:var(--text-muted); margin-top:0.15rem;">{{ $promo->subtitle }}</div>
                            @endif
                        </td>
                        <td>
                            @if($promo->badge_text)
                                <span class="badge badge-orange">{{ $promo->badge_text }}</span>
                            @else
                                <span style="color:var(--text-muted);">—</span>
                            @endif
                        </td>
                        <td style="color:var(--text-mid);">{{ $promo->sort_order }}</td>
                        <td>
                            @if($promo->is_active)
                                <span class="badge badge-green">✅ Activa</span>
                            @else
                                <span class="badge badge-gray">❌ Inactiva</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:0.5rem;">
                                <a href="{{ route('admin.promotions.edit', $promo) }}" class="btn btn-ghost btn-sm">✏️ Editar</a>
                                <form method="POST" action="{{ route('admin.promotions.destroy', $promo) }}"
                                      onsubmit="return confirm('¿Eliminar esta promoción?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:rgba(224,82,82,0.12); color:#f87171; border:1px solid rgba(224,82,82,0.2);">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:1rem 1.5rem;">{{ $promotions->links() }}</div>
        @endif
    </div>
</div>

@endsection
