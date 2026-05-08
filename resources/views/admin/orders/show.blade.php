@extends('layouts.admin')
@section('page-title', 'Pedido #' . $order->id)
@section('page-subtitle', 'Detalle del pedido de ' . $order->user->name)
@section('topbar-actions')
    <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm">← Volver</a>
@endsection

@section('content')

<div style="display:grid; grid-template-columns:1fr 380px; gap:1.5rem; align-items:start;">

    {{-- Detalle del pedido --}}
    <div>
        <div class="admin-card" style="margin-bottom:1.5rem;">
            <div class="admin-card-header">
                <span class="admin-card-title">🧾 Items del pedido</span>
                <span style="color:var(--primary-light); font-weight:700; font-size:1.1rem;">
                    Total: {{ $order->total_formatted }}
                </span>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio unit.</th>
                        <th>Cant.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:var(--text-light);">{{ $item->menuItem->name ?? '(eliminado)' }}</div>
                            @if($item->menuItem)
                                <div style="font-size:0.75rem; color:var(--text-muted);">{{ $item->menuItem->category }}</div>
                            @endif
                            @if(is_array($item->customizations))
                                <div style="margin-top:0.4rem; font-size:0.8rem;">
                                    @if(!empty($item->customizations['removed']))
                                        <div style="color:#d9534f; margin-bottom:0.2rem;">
                                            <strong style="color:#d9534f; font-size:0.75rem;">SIN:</strong> 
                                            {{ implode(', ', $item->customizations['removed']) }}
                                        </div>
                                    @endif
                                    @if(!empty($item->customizations['extras']))
                                        <div style="color:#5cb85c;">
                                            <strong style="color:#5cb85c; font-size:0.75rem;">EXTRAS:</strong> 
                                            @foreach($item->customizations['extras'] as $extra)
                                                {{ $extra['name'] }} (+${{ number_format($extra['price'], 0) }})@if(!$loop->last), @endif
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td>
                            @php
                                $p = (float)$item->unit_price;
                                echo '$' . ($p >= 1000 ? number_format($p/1000,1).'K' : number_format($p,0));
                            @endphp
                        </td>
                        <td style="color:var(--text-light); font-weight:700;">× {{ $item->quantity }}</td>
                        <td style="color:var(--primary-light); font-weight:700;">
                            @php
                                $s = $item->subtotal;
                                echo '$' . ($s >= 1000 ? number_format($s/1000,1).'K' : number_format($s,0));
                            @endphp
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($order->address || $order->notes)
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title">📍 Información adicional</span>
            </div>
            <div class="admin-card-body">
                @if($order->payment_method)
                    <div style="margin-bottom:1rem; padding-bottom:1rem; border-bottom:1px solid var(--border);">
                        <div class="form-label">Tipo de Pedido</div>
                        <div style="color:var(--text-light); margin-bottom: 1rem;">
                            @if($order->order_type === 'pickup')
                                <span class="badge" style="background:rgba(255,255,255,0.1); color:#fff; font-size:1rem; padding: 0.5rem 1rem;">🏪 Recoger en el Local</span>
                            @else
                                <span class="badge" style="background:rgba(224,120,32,0.15); color:var(--primary-light); font-size:1rem; padding: 0.5rem 1rem;">🛵 Entrega a Domicilio</span>
                            @endif
                        </div>

                        <div class="form-label">Método de pago</div>
                        <div style="color:var(--text-light); display:flex; align-items:center; gap:0.5rem;">
                            @if($order->payment_method === 'transfer')
                                🏦 Transferencia Bancaria
                                @if($order->payment_receipt_url)
                                    <a href="{{ $order->payment_receipt_url }}" target="_blank" class="btn btn-ghost btn-sm" style="padding:0.2rem 0.5rem; font-size:0.75rem;">Ver Comprobante 👀</a>
                                @endif
                            @else
                                💵 Efectivo
                            @endif
                        </div>
                    </div>
                @endif
                @if($order->order_type !== 'pickup' && ($order->address || $order->userAddress))
                    <div style="margin-bottom:0.75rem;">
                        <div class="form-label">Dirección de entrega</div>
                        <div style="color:var(--text-light);">{{ $order->address ?? ($order->userAddress ? $order->userAddress->address : '') }}</div>
                    </div>
                @endif
                @if($order->notes)
                    <div>
                        <div class="form-label">Notas</div>
                        <div style="color:var(--text-mid);">{{ $order->notes }}</div>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- Panel lateral: cliente + estado --}}
    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        {{-- Info cliente --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title">👤 Cliente</span>
            </div>
            <div class="admin-card-body">
                <div style="font-size:1rem; font-weight:700; color:var(--text-light);">{{ $order->user->name }}</div>
                <div style="font-size:0.85rem; color:var(--text-muted);">{{ $order->user->email }}</div>
                <div style="font-size:0.78rem; color:var(--text-muted); margin-top:0.5rem;">
                    Pedido el {{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}
                </div>
            </div>
        </div>

        {{-- Estado actual --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <span class="admin-card-title">📊 Estado del pedido</span>
            </div>
            <div class="admin-card-body">
                {{-- Timeline visual --}}
                @php
                    $steps = [
                        'pending_payment' => ['💳', 'Pago'],
                        'pending'   => ['⏳', 'Pendiente'],
                        'preparing' => ['🔥', 'Preparación'],
                        'on_way'    => ['🚀', 'En Camino'],
                        'delivered' => ['✅', 'Entregado'],
                    ];
                    $currentIdx = $order->status_index;
                @endphp

                <div class="status-timeline">
                    @php $stepKeys = array_keys($steps); @endphp
                    @foreach($steps as $key => [$icon, $label])
                        @php $idx = array_search($key, $stepKeys); @endphp
                        <div class="st-step">
                            @if($idx < count($stepKeys) - 1)
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

                <div style="margin-top:1.5rem;">
                    <div class="form-label" style="margin-bottom:0.6rem;">Cambiar estado</div>
                    <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                        @csrf @method('PATCH')
                        <div style="display:flex; gap:0.75rem; align-items:center;">
                            <select name="status" class="form-input" style="flex:1;">
                                <option value="pending_payment" {{ $order->status === 'pending_payment' ? 'selected' : '' }}>💳 Pendiente de Pago</option>
                                <option value="pending"   {{ $order->status === 'pending'   ? 'selected' : '' }}>⏳ Pendiente</option>
                                <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>🔥 En Preparación</option>
                                <option value="on_way"    {{ $order->status === 'on_way'    ? 'selected' : '' }}>🚀 En Camino</option>
                                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>✅ Entregado</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
