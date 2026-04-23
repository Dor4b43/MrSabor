<x-app-layout>
<div class="dashboard-content" style="max-width:780px;">

    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:2rem;">
        <a href="{{ route('orders.index') }}" class="btn btn-ghost btn-sm">← Mis pedidos</a>
        <h2 style="font-size:1.3rem; font-weight:700; color:var(--text-light);">Pedido #{{ $order->id }}</h2>
        <span class="badge badge-{{ $order->status_color }}" style="margin-left:auto;">
            {{ $order->status_icon }} {{ $order->status_label }}
        </span>
    </div>

    {{-- Timeline de estado --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <span class="admin-card-title">📍 Seguimiento de tu pedido</span>
        </div>
        <div style="padding:2rem 1.5rem;">
            @php
                $steps = [
                    'pending'   => ['⏳', 'Recibido',     'Tu pedido fue recibido'],
                    'preparing' => ['🔥', 'Preparación',  'Estamos preparando tu pedido'],
                    'on_way'    => ['🚀', 'En Camino',    'Tu pedido está en camino'],
                    'delivered' => ['✅', 'Entregado',    '¡Disfruta tu pedido!'],
                ];
                $statusFlow = array_keys($steps);
                
                // Manejar estado cancelado
                $isCancelled = $order->status === 'cancelled';
                $currentIdx = $isCancelled ? -1 : ($order->status_index ?? array_search($order->status, $statusFlow));
            @endphp

            <div class="status-timeline" style="margin:0 0 1.5rem;">
                @foreach($steps as $key => [$icon, $label, $desc])
                    @php $idx = array_search($key, $statusFlow); @endphp
                    <div class="st-step">
                        @if($idx < count($statusFlow) - 1)
                            <div style="position:absolute; top:19px; left:50%; width:100%; height:3px; z-index:0;
                                 background:{{ $idx < $currentIdx ? '#6dc558' : 'var(--border)' }};"></div>
                        @endif
                        <div class="st-dot {{ $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'active' : '') }}">
                            {{ $icon }}
                        </div>
                        <div class="st-label">{{ $label }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Mensaje del estado actual --}}
            @if($isCancelled)
                <div style="text-align:center; padding:1rem; background:rgba(220,38,38,0.07); border-radius:12px; border:1px solid rgba(220,38,38,0.15);">
                    <div style="font-size:2rem; margin-bottom:0.4rem;">🚫</div>
                    <div style="font-weight:700; color:var(--text-light); margin-bottom:0.2rem;">Cancelado</div>
                    <div style="font-size:0.85rem; color:var(--danger, #ef4444);">El pedido fue cancelado.</div>
                </div>
            @else
                @php [$icon, $label, $desc] = $steps[$order->status] ?? $steps['pending']; @endphp
                <div style="text-align:center; padding:1rem; background:rgba(224,120,32,0.07); border-radius:12px; border:1px solid rgba(224,120,32,0.15);">
                    <div style="font-size:2rem; margin-bottom:0.4rem;">{{ $icon }}</div>
                    <div style="font-weight:700; color:var(--text-light); margin-bottom:0.2rem;">{{ $label }}</div>
                    <div style="font-size:0.85rem; color:var(--text-muted);">{{ $desc }}</div>
                </div>
            @endif
        </div>
    </div>

    {{-- Items del pedido --}}
    <div class="admin-card" style="margin-bottom:1.5rem;">
        <div class="admin-card-header">
            <span class="admin-card-title">🧾 Detalle del pedido</span>
            <span style="font-size:1.1rem; font-weight:800; color:var(--primary-light);">{{ $order->total_formatted }}</span>
        </div>
        <div style="overflow-x:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio unit.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td style="color:var(--text-light); font-weight:600;">
                            {{ $item->menuItem->name ?? '(Producto eliminado)' }}
                        </td>
                        <td style="font-weight:700; color:var(--text-light);">× {{ $item->quantity }}</td>
                        <td>
                            @php $p = (float)$item->unit_price; @endphp
                            ${{ $p >= 1000 ? number_format($p/1000,1).'K' : number_format($p,0) }}
                        </td>
                        <td style="color:var(--primary-light); font-weight:700;">
                            @php $s = $item->subtotal; @endphp
                            ${{ $s >= 1000 ? number_format($s/1000,1).'K' : number_format($s,0) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($order->address || $order->notes)
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">📍 Información adicional</span>
        </div>
        <div class="admin-card-body">
            @if($order->address)
                <p style="color:var(--text-light); margin-bottom:0.5rem;"><strong>Dirección:</strong> {{ $order->address }}</p>
            @endif
            @if($order->notes)
                <p style="color:var(--text-mid);"><strong>Notas:</strong> {{ $order->notes }}</p>
            @endif
        </div>
    </div>
    @endif

    <div style="margin-top:1.5rem; text-align:center;">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">🍔 Hacer otro pedido</a>
    </div>

    @if(!$isCancelled && $order->created_at->diffInMinutes(now()) <= 3)
    <div style="margin-top:1rem; text-align:center;">
        <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('¿Estás seguro de cancelar este pedido? Solo se puede durante los primeros 3 minutos.');">
            @csrf
            <button type="submit" class="btn" style="background:transparent; border:1px solid red; color:red; font-size:0.85rem; padding:0.4rem 1rem;">
                🚫 Cancelar Pedido (Tienes hasta 3 minutos)
            </button>
        </form>
    </div>
    @endif

</div>
</x-app-layout>
