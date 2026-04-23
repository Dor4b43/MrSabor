<x-app-layout>
<div class="dashboard-content">

    {{-- Bienvenida --}}
    <div class="welcome-card">
        <div class="welcome-avatar">🔥</div>
        <div class="welcome-text">
            <h2>¡Hola, {{ Auth::user()->name }}! 👋</h2>
            <p>¿Qué se te antoja hoy? Revisa nuestro menú y haz tu pedido.</p>
        </div>
        <div style="margin-left:auto; display:flex; gap:0.75rem;">
            <a href="{{ route('orders.index') }}" class="btn btn-ghost btn-sm">📦 Mis pedidos</a>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:1.5rem;">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom:1.5rem;">❌ {{ session('error') }}</div>
    @endif

    {{-- Pedidos recientes --}}
    @if($myOrders->isNotEmpty())
    <div style="margin-bottom:2rem;">
        <div class="section-header">
            <span class="section-title">📦 Mis pedidos recientes</span>
            <div class="section-header-line"></div>
            <a href="{{ route('orders.index') }}" style="font-size:0.82rem; color:var(--primary-light); text-decoration:none; white-space:nowrap;">Ver todos →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1rem;">
            @foreach($myOrders as $order)
            <a href="{{ route('orders.show', $order) }}"
               style="text-decoration:none; display:block; background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:1.25rem; transition:all 0.3s;"
               onmouseover="this.style.borderColor='rgba(224,120,32,0.35)'; this.style.transform='translateY(-3px)'"
               onmouseout="this.style.borderColor=''; this.style.transform=''">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.6rem;">
                    <span style="font-size:0.8rem; color:var(--text-muted);">#{{ $order->id }}</span>
                    <span class="badge badge-{{ $order->status_color }}">{{ $order->status_icon }} {{ $order->status_label }}</span>
                </div>
                <div style="font-size:0.85rem; color:var(--text-mid);">{{ $order->items->sum('quantity') }} item(s)</div>
                <div style="font-size:1.2rem; font-weight:800; color:var(--primary-light); margin-top:0.35rem;">{{ $order->total_formatted }}</div>
                <div style="font-size:0.75rem; color:var(--text-muted); margin-top:0.4rem;">{{ $order->created_at->diffForHumans() }}</div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- MENÚ --}}
    @if($menuItems->isEmpty())
        <div style="text-align:center; padding:4rem 2rem; color:var(--text-muted);">
            <div style="font-size:5rem; margin-bottom:1rem;">🍽️</div>
            <h3 style="font-size:1.4rem; color:var(--text-light); margin-bottom:0.5rem;">El menú está siendo preparado</h3>
            <p>El equipo de Mr. Sabor está configurando los productos. ¡Vuelve pronto!</p>
        </div>
    @else
        {{-- Formulario de pedido --}}
        <form method="POST" action="{{ route('orders.store') }}" id="order-form">
            @csrf

            @foreach($menuItems as $category => $items)
                <div class="section-header" id="{{ Str::slug($category) }}">
                    <span class="section-title">
                        @if($category === 'Burgers') 🍔
                        @elseif($category === 'Salchipapas') 🍟
                        @elseif($category === 'Platos') 🍽️
                        @elseif($category === 'Bebidas') 🥤
                        @elseif($category === 'Postres') 🍰
                        @else 🌟
                        @endif
                        {{ $category }}
                    </span>
                    <div class="section-header-line"></div>
                </div>

                <div class="menu-grid" style="margin-bottom:1.5rem;">
                    @foreach($items as $item)
                    <div class="product-card" id="card-{{ $item->id }}">
                        <div class="product-emoji-wrap">
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}"
                                     alt="{{ $item->name }}"
                                     style="width:100%; height:160px; object-fit:cover;">
                            @else
                                <span class="product-emoji">
                                    @if($category === 'Burgers') 🍔
                                    @elseif($category === 'Salchipapas') 🍟
                                    @elseif($category === 'Platos') 🍽️
                                    @elseif($category === 'Bebidas') 🥤
                                    @else 🌟
                                    @endif
                                </span>
                            @endif
                        </div>
                        <div class="product-body">
                            <span class="product-category-tag">{{ $category }}</span>
                            <h3 class="product-name">{{ strtoupper($item->name) }}</h3>
                            @if($item->description)
                                <p class="product-desc">{{ $item->description }}</p>
                            @endif
                            <div class="product-footer">
                                <span class="product-price">{{ $item->price_formatted }}</span>
                                {{-- Contador de cantidad --}}
                                <div style="display:flex; align-items:center; gap:0.5rem;">
                                    <button type="button" onclick="changeQty({{ $item->id }}, -1)"
                                        style="width:28px; height:28px; border-radius:50%; background:var(--bg-elevated); border:1px solid var(--border); color:var(--text-light); cursor:pointer; font-size:1rem; display:flex; align-items:center; justify-content:center;">−</button>
                                    <span id="qty-display-{{ $item->id }}"
                                          style="min-width:20px; text-align:center; font-weight:700; color:var(--text-light);">0</span>
                                    <button type="button" onclick="changeQty({{ $item->id }}, 1)"
                                        class="btn-add">+</button>
                                    <input type="hidden" name="items[{{ $item->id }}][id]"       value="{{ $item->id }}">
                                    <input type="hidden" name="items[{{ $item->id }}][quantity]" value="0"
                                           id="qty-input-{{ $item->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach

            {{-- Barra de pedido flotante --}}
            <div id="order-bar" style="display:none; position:fixed; bottom:1.5rem; left:50%; transform:translateX(-50%);
                 background:var(--bg-elevated); border:1px solid rgba(224,120,32,0.35);
                 box-shadow:0 20px 60px rgba(0,0,0,0.5), 0 0 30px rgba(224,120,32,0.15);
                 border-radius:20px; padding:1rem 1.75rem; z-index:1000;
                 display:flex !important; align-items:center; gap:1.5rem; min-width:360px;
                 opacity:0; transition:opacity 0.3s ease;" id="order-bar">
                <div>
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.5px;">Tu pedido</div>
                    <div style="color:var(--text-light); font-weight:700;">
                        <span id="bar-items">0</span> item(s) ·
                        <span id="bar-total" style="color:var(--primary-light);">$0</span>
                    </div>
                </div>
                <div style="display:flex; gap:0.75rem; align-items:center; margin-left:auto;">
                    @if($addresses->isEmpty())
                        <a href="{{ route('profile.edit') }}" style="color:var(--text-light); text-decoration:underline; font-size:0.85rem; padding-right:1rem;">Añadir Dirección</a>
                        <input type="hidden" name="address_id" value="">
                    @else
                        <select name="address_id" required
                               style="background:var(--bg-card); border:1px solid var(--border); color:var(--text-light);
                                      padding:0.5rem 0.875rem; border-radius:10px; font-size:0.85rem; width:200px;
                                      font-family:'Poppins',sans-serif; outline:none;">
                            <option value="">📍 Selecciona dirección...</option>
                            @foreach($addresses as $addr)
                                <option value="{{ $addr->id }}">{{ $addr->address }} {{ $addr->reference ? '('.$addr->reference.')' : '' }}</option>
                            @endforeach
                        </select>
                    @endif
                    <button type="submit" class="btn btn-primary" id="btn-submit-order">Pedir 🔥</button>
                </div>
            </div>

        </form>
    @endif

</div>

<script>
const prices = {
    @foreach($menuItems->flatten() as $item)
    {{ $item->id }}: {{ (float)$item->price }},
    @endforeach
};
const deliveryFee = {{ (float)$deliveryFee }};
const qtys = {};
let totalItems = 0, totalPrice = 0;

function changeQty(id, delta) {
    qtys[id] = Math.max(0, (qtys[id] || 0) + delta);
    document.getElementById('qty-display-' + id).textContent = qtys[id];
    document.getElementById('qty-input-' + id).value = qtys[id];

    // highlight card
    const card = document.getElementById('card-' + id);
    if (qtys[id] > 0) {
        card.style.borderColor = 'rgba(224,120,32,0.45)';
        card.style.background  = 'rgba(224,120,32,0.05)';
    } else {
        card.style.borderColor = '';
        card.style.background  = '';
    }

    recalc();
}

function recalc() {
    totalItems = 0; totalPrice = 0;
    for (const [id, q] of Object.entries(qtys)) {
        if (q > 0 && prices[id]) { totalItems += q; totalPrice += prices[id] * q; }
    }

    if (totalItems > 0) {
        totalPrice += deliveryFee;
    }

    const bar = document.getElementById('order-bar');
    document.getElementById('bar-items').textContent = totalItems;
    const fmt = totalPrice >= 1000 ? '$' + (totalPrice/1000).toFixed(1) + 'K' : '$' + totalPrice.toFixed(0);
    document.getElementById('bar-total').textContent = fmt + ' (Inc. Domicilio)';

    if (totalItems > 0) {
        bar.style.display = 'flex';
        setTimeout(() => bar.style.opacity = '1', 10);
    } else {
        bar.style.opacity = '0';
        setTimeout(() => bar.style.display = 'none', 300);
    }
}

// Filter zero-quantity items before submit
document.getElementById('order-form')?.addEventListener('submit', function(e) {
    let addressValue = document.querySelector('select[name="address_id"]')?.value;
    let hasAddressSelect = document.querySelector('select[name="address_id"]') !== null;
    
    if (hasAddressSelect && !addressValue) {
        e.preventDefault();
        alert('Por favor selecciona una dirección de entrega.');
        return false;
    } else if (!hasAddressSelect) {
        e.preventDefault();
        alert('Debes agregar una dirección antes de hacer el pedido. Ve a tu perfil.');
        return false;
    }

    for (const [id, q] of Object.entries(qtys)) {
        if (q < 1) {
            const inp = document.getElementById('qty-input-' + id);
            if (inp) inp.disabled = true;
        }
    }
});
</script>

</x-app-layout>
