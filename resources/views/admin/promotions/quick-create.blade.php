@extends('layouts.admin')
@section('page-title', 'Promo Rápida')
@section('page-subtitle', 'Crea una promoción en segundos usando un producto del menú')
@section('topbar-actions')
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

{{-- Datos de productos para JS --}}
<script>
const menuItems = {
    @foreach($menuItems as $item)
    {{ $item->id }}: {
        name: @json($item->name),
        description: @json($item->description ?? ''),
        price: "{{ $item->price_formatted }}",
        image: "{{ $item->image_url ?? '' }}"
    },
    @endforeach
};
</script>

<div style="display:grid; grid-template-columns:1fr 380px; gap:1.5rem; align-items:start;">

    {{-- ── FORMULARIO ─────────────────────────────────────── --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">⚡ Crear promo rápida</span>
        </div>
        <div class="admin-card-body">
            <form method="POST" action="{{ route('admin.promotions.quick-store') }}" id="quick-promo-form">
                @csrf

                {{-- 1. Nombre de la promo --}}
                <div class="admin-form-group">
                    <label class="form-label" for="promo_name">Nombre de la promoción *</label>
                    <input id="promo_name" name="promo_name" type="text" class="form-input {{ $errors->has('promo_name') ? 'is-invalid' : '' }}"
                        value="{{ old('promo_name') }}" required placeholder="Ej: 2x1 en la Clásica, Precio especial del día…"
                        oninput="updatePreview()">
                    @error('promo_name')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                {{-- 2. Seleccionar producto --}}
                <div class="admin-form-group">
                    <label class="form-label" for="menu_item_id">Producto del menú *</label>
                    @if($menuItems->isEmpty())
                        <div style="padding:1rem; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); border-radius:10px; color:#f87171; font-size:0.85rem;">
                            ⚠️ No hay productos disponibles. <a href="{{ route('admin.menu-items.create') }}" style="color:#fb923c;">Crear un producto primero →</a>
                        </div>
                    @else
                        <select id="menu_item_id" name="menu_item_id" class="form-input {{ $errors->has('menu_item_id') ? 'is-invalid' : '' }}"
                                required onchange="updatePreview()">
                            <option value="">— Selecciona un producto —</option>
                            @foreach($menuItems as $item)
                                <option value="{{ $item->id }}" {{ old('menu_item_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }} · {{ $item->price_formatted }}
                                </option>
                            @endforeach
                        </select>
                        @error('menu_item_id')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                    @endif
                </div>

                {{-- 3. Tipo de descuento --}}
                <div class="admin-form-group">
                    <label class="form-label">Tipo de oferta *</label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.75rem;">
                        @php
                            $types = [
                                'percent'       => ['icon'=>'%',  'label'=>'Porcentaje', 'desc'=>'20% OFF'],
                                'fixed'         => ['icon'=>'$',  'label'=>'Valor fijo',  'desc'=>'- $5.000 OFF'],
                                '2x1'           => ['icon'=>'2×','label'=>'2x1',          'desc'=>'Lleva 2, paga 1'],
                                'free_delivery' => ['icon'=>'🛵', 'label'=>'Envío gratis', 'desc'=>'Sin costo de entrega'],
                            ];
                        @endphp
                        @foreach($types as $val => $t)
                        <label class="discount-option {{ old('discount_type') == $val ? 'selected' : '' }}" for="dt_{{ $val }}"
                               onclick="selectDiscount('{{ $val }}')">
                            <input type="radio" id="dt_{{ $val }}" name="discount_type" value="{{ $val }}"
                                   {{ old('discount_type') == $val ? 'checked' : '' }} required>
                            <span class="discount-icon">{{ $t['icon'] }}</span>
                            <div>
                                <div style="font-weight:700; font-size:0.88rem; color:var(--text-light);">{{ $t['label'] }}</div>
                                <div style="font-size:0.74rem; color:var(--text-muted);">{{ $t['desc'] }}</div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('discount_type')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                {{-- 4. Valor del descuento (solo si aplica) --}}
                <div class="admin-form-group" id="discount-value-wrap" style="display:none;">
                    <label class="form-label" for="discount_value" id="discount-value-label">Valor del descuento *</label>
                    <input id="discount_value" name="discount_value" type="number" min="0" step="any"
                           class="form-input" value="{{ old('discount_value') }}"
                           placeholder="Ej: 20" oninput="updatePreview()">
                    @error('discount_value')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                {{-- 5. Duración --}}
                <div class="admin-form-group">
                    <label class="form-label">¿Por cuánto tiempo? *</label>
                    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:0.6rem;">
                        @php
                            $durations = [
                                'today'     => ['🔥', 'Solo por hoy'],
                                'weekend'   => ['📅', 'Este fin de semana'],
                                'limited'   => ['⏳', 'Tiempo limitado'],
                                'permanent' => ['♾️', 'Sin vencimiento'],
                            ];
                        @endphp
                        @foreach($durations as $val => [$icon, $label])
                        <label class="duration-option {{ old('duration') == $val ? 'selected' : '' }}" for="dur_{{ $val }}"
                               onclick="selectDuration('{{ $val }}')">
                            <input type="radio" id="dur_{{ $val }}" name="duration" value="{{ $val }}"
                                   {{ old('duration') == $val ? 'checked' : '' }} required>
                            <div style="font-size:1.4rem;">{{ $icon }}</div>
                            <div style="font-size:0.72rem; color:var(--text-mid); margin-top:0.2rem;">{{ $label }}</div>
                        </label>
                        @endforeach
                    </div>
                    @error('duration')<p class="form-error">⚠️ {{ $message }}</p>@enderror
                </div>

                <div style="display:flex; gap:0.75rem; margin-top:0.5rem;">
                    <button type="submit" class="btn btn-sm" style="background:linear-gradient(135deg,#f97316,#ef4444); color:#fff; border:none; font-weight:700; padding:0.6rem 1.5rem; box-shadow:0 2px 8px rgba(249,115,22,0.35);">
                        ⚡ Crear promo
                    </button>
                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    {{-- ── PREVIEW CARD ───────────────────────────────────── --}}
    <div style="position:sticky; top:1.5rem;">
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title" style="font-size:0.85rem;">👁️ Vista previa</span>
            </div>
            <div style="padding:1.25rem;">
                {{-- Imagen --}}
                <div id="preview-img-wrap" style="width:100%; height:160px; background:rgba(255,255,255,0.04); border-radius:12px; overflow:hidden; margin-bottom:1rem; display:flex; align-items:center; justify-content:center; border:1px solid var(--border);">
                    <img id="preview-img" src="" alt="" style="width:100%; height:100%; object-fit:cover; display:none;">
                    <span id="preview-img-placeholder" style="font-size:3rem;">🍔</span>
                </div>
                {{-- Badge --}}
                <div style="margin-bottom:0.5rem;">
                    <span id="preview-badge" class="badge badge-orange" style="display:none;"></span>
                </div>
                {{-- Título --}}
                <div id="preview-title" style="font-size:1.1rem; font-weight:800; color:var(--text-light); margin-bottom:0.25rem;">Nombre de la promo</div>
                {{-- Subtítulo duración --}}
                <div id="preview-subtitle" style="font-size:0.8rem; color:var(--text-muted); margin-bottom:0.5rem;"></div>
                {{-- Producto --}}
                <div id="preview-product" style="font-size:0.82rem; color:var(--text-mid);"></div>
            </div>
        </div>

        <div style="margin-top:0.75rem; padding:0.75rem 1rem; background:rgba(249,115,22,0.07); border:1px solid rgba(249,115,22,0.15); border-radius:10px; font-size:0.78rem; color:var(--text-muted); line-height:1.6;">
            💡 La promo usará automáticamente la <strong style="color:var(--text-mid);">imagen y descripción</strong> del producto seleccionado.
        </div>
    </div>

</div>

<style>
.discount-option, .duration-option {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.75rem;
    border-radius: 10px;
    border: 1px solid var(--border);
    cursor: pointer;
    transition: all 0.18s;
    background: rgba(255,255,255,0.02);
}
.discount-option input, .duration-option input { display:none; }
.discount-option:hover, .duration-option:hover { border-color: rgba(249,115,22,0.4); background: rgba(249,115,22,0.06); }
.discount-option.selected, .duration-option.selected {
    border-color: #f97316;
    background: rgba(249,115,22,0.12);
    box-shadow: 0 0 0 2px rgba(249,115,22,0.2);
}
.discount-icon {
    font-size: 1.2rem;
    font-weight: 900;
    color: #f97316;
    min-width: 1.5rem;
    text-align: center;
}
.duration-option {
    flex-direction: column;
    text-align: center;
    justify-content: center;
    padding: 0.75rem 0.4rem;
}
</style>

<script>
function selectDiscount(val) {
    document.querySelectorAll('.discount-option').forEach(el => el.classList.remove('selected'));
    document.querySelector(`label[for="dt_${val}"]`).classList.add('selected');

    const wrap  = document.getElementById('discount-value-wrap');
    const label = document.getElementById('discount-value-label');
    const input = document.getElementById('discount_value');

    if (val === 'percent') {
        wrap.style.display = 'block';
        label.textContent  = 'Porcentaje de descuento (%) *';
        input.placeholder  = 'Ej: 20';
    } else if (val === 'fixed') {
        wrap.style.display = 'block';
        label.textContent  = 'Valor a descontar ($) *';
        input.placeholder  = 'Ej: 5000';
    } else {
        wrap.style.display = 'none';
        input.value = '';
    }
    updatePreview();
}

const durationLabels = {
    today:     '🔥 Solo por hoy',
    weekend:   '📅 Solo este fin de semana',
    limited:   '⏳ Por tiempo limitado',
    permanent: '',
};

function selectDuration(val) {
    document.querySelectorAll('.duration-option').forEach(el => el.classList.remove('selected'));
    document.querySelector(`label[for="dur_${val}"]`).classList.add('selected');
    updatePreview();
}

function updatePreview() {
    const nameEl    = document.getElementById('promo_name');
    const selectEl  = document.getElementById('menu_item_id');
    const discRadio = document.querySelector('input[name="discount_type"]:checked');
    const durRadio  = document.querySelector('input[name="duration"]:checked');
    const discVal   = document.getElementById('discount_value')?.value;

    // Título
    document.getElementById('preview-title').textContent =
        nameEl?.value || 'Nombre de la promo';

    // Imagen y producto
    const img  = document.getElementById('preview-img');
    const ph   = document.getElementById('preview-img-placeholder');
    const prod = document.getElementById('preview-product');

    if (selectEl?.value && menuItems[selectEl.value]) {
        const item = menuItems[selectEl.value];
        if (item.image) {
            img.src = item.image;
            img.style.display = 'block';
            ph.style.display  = 'none';
        } else {
            img.style.display = 'none';
            ph.style.display  = 'block';
        }
        prod.textContent = item.name + ' · ' + item.price;
    } else {
        img.style.display = 'none';
        ph.style.display  = 'block';
        prod.textContent  = '';
    }

    // Badge
    const badge = document.getElementById('preview-badge');
    if (discRadio) {
        let badgeText = '';
        if (discRadio.value === 'percent' && discVal) badgeText = discVal + '% OFF';
        else if (discRadio.value === 'fixed' && discVal) badgeText = '- $' + Number(discVal).toLocaleString('es') + ' OFF';
        else if (discRadio.value === '2x1') badgeText = '2x1';
        else if (discRadio.value === 'free_delivery') badgeText = 'Envío gratis';

        if (badgeText) {
            badge.textContent   = badgeText;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }
    } else {
        badge.style.display = 'none';
    }

    // Duración
    const sub = document.getElementById('preview-subtitle');
    sub.textContent = durRadio ? (durationLabels[durRadio.value] || '') : '';
}
</script>

@endsection
