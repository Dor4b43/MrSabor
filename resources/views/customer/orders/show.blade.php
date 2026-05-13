<x-app-layout>
<style>
    .status-timeline {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
        margin: 2.5rem 0 2rem;
    }
    .st-step {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        z-index: 2;
        text-align: center;
    }
    .st-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 22px;
        left: 50%;
        width: 100%;
        height: 4px;
        background: rgba(255,255,255,0.05);
        z-index: -1;
        border-radius: 2px;
    }
    .st-step.completed:not(:last-child)::after {
        background: rgba(74,222,128,0.5); 
    }
    .st-step.active:not(:last-child)::after {
        background: linear-gradient(90deg, rgba(224,120,32,0.8) 0%, rgba(255,255,255,0.05) 100%);
    }
    .st-dot {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--bg-deep);
        border: 2px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    }
    .st-dot.done {
        background: rgba(74,222,128,0.15);
        border-color: #4ade80;
        color: #4ade80;
    }
    .st-dot.active {
        background: rgba(224,120,32,0.2);
        border-color: #E07820;
        box-shadow: 0 0 20px rgba(224,120,32,0.4);
        transform: scale(1.15);
    }
    .st-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .st-step.completed .st-label {
        color: #4ade80;
    }
    .st-step.active .st-label {
        color: #E07820;
    }
    
    .order-item-card {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: border-color 0.3s;
    }
    .order-item-card:hover {
        border-color: rgba(224,120,32,0.2);
        background: rgba(255,255,255,0.04);
    }
    
    .item-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .item-qty {
        background: rgba(224,120,32,0.15);
        color: #E07820;
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-weight: 800;
        font-size: 1rem;
        border: 1px solid rgba(224,120,32,0.3);
    }
    
    .item-name {
        font-weight: 700;
        color: #F2E8D5;
        font-size: 1.05rem;
        margin-bottom: 0.2rem;
    }
    
    .item-price {
        color: var(--primary-light);
        font-weight: 800;
        font-size: 1.15rem;
    }
    
    .customizations-list {
        font-size: 0.8rem;
        color: #8A7460;
        margin-top: 0.3rem;
    }
</style>

<div class="dashboard-content" style="max-width:850px; margin: 0 auto; padding: 2rem 1rem;">

    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:2rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
        <a href="{{ route('orders.index') }}" class="btn btn-ghost btn-sm" style="padding:0.5rem; border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center;"><i class="ph ph-arrow-left" style="font-size:1.2rem;"></i></a>
        <div>
            <h2 style="font-size:1.5rem; font-weight:800; color:var(--text-light); line-height:1.2;">Pedido #{{ $order->id }}</h2>
            <span style="font-size:0.85rem; color:var(--text-muted);">{{ $order->created_at->format('d M, Y - h:i A') }}</span>
        </div>
        <span class="badge badge-{{ $order->status_color }}" style="margin-left:auto; font-size:0.9rem; padding:0.5rem 1rem;">
            <i class="ph ph-{{ $order->status_icon }}"></i> {{ $order->status_label }}
        </span>
    </div>

    {{-- Timeline de estado --}}
    <div class="admin-card" style="margin-bottom:2rem; background: rgba(25, 20, 18, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(224,120,32,0.15);">
        <div class="admin-card-header" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
            <span class="admin-card-title" style="display:flex; align-items:center; gap:0.5rem;"><i class="ph ph-map-pin-line" style="color:#E07820;"></i> Seguimiento del pedido</span>
        </div>
        <div style="padding:1.5rem;">
            @php
                $steps = [
                    'pending'   => ['<i class="ph ph-hourglass-high"></i>', 'Recibido',     'Tu pedido fue recibido'],
                    'preparing' => ['<i class="ph ph-fire"></i>',           'Preparación',  'Estamos preparando tu pedido'],
                    'on_way'    => ['<i class="ph ph-rocket"></i>',         'En Camino',    'Tu pedido está en camino'],
                    'delivered' => ['<i class="ph ph-check-circle"></i>',   'Entregado',    '¡Disfruta tu pedido!'],
                ];
                $statusFlow = array_keys($steps);
                
                // Manejar estado cancelado
                $isCancelled = $order->status === 'cancelled';
                $currentIdx = $isCancelled ? -1 : ($order->status_index ?? array_search($order->status, $statusFlow));
            @endphp

            @if(!$isCancelled)
            <div class="status-timeline">
                @foreach($steps as $key => [$icon, $label, $desc])
                    @php 
                        $idx = array_search($key, $statusFlow); 
                        $isDone = $idx < $currentIdx;
                        $isActive = $idx === $currentIdx;
                        $stepClass = $isDone ? 'completed' : ($isActive ? 'active' : '');
                        $dotClass = $isDone ? 'done' : ($isActive ? 'active' : '');
                    @endphp
                    <div class="st-step {{ $stepClass }}">
                        <div class="st-dot {{ $dotClass }}">
                            {!! $icon !!}
                        </div>
                        <div class="st-label">{{ $label }}</div>
                    </div>
                @endforeach
            </div>
            @endif

            {{-- Mensaje del estado actual --}}
            @if($isCancelled)
                <div style="text-align:center; padding:2rem 1rem; background:rgba(220,38,38,0.05); border-radius:12px; border:1px solid rgba(220,38,38,0.2);">
                    <div style="font-size:3rem; margin-bottom:1rem; color:#ef4444;"><i class="ph ph-x-circle"></i></div>
                    <div style="font-weight:800; font-size:1.5rem; color:#ef4444; margin-bottom:0.5rem;">Pedido Cancelado</div>
                    <div style="font-size:1rem; color:var(--text-light);">Este pedido fue cancelado y no será procesado.</div>
                </div>
            @else
                @php [$icon, $label, $desc] = $steps[$order->status] ?? $steps['pending']; @endphp
                <div style="text-align:center; padding:1.5rem; background:rgba(224,120,32,0.05); border-radius:16px; border:1px solid rgba(224,120,32,0.1);">
                    <div style="font-size:2.5rem; margin-bottom:0.5rem; color:#E07820;">{!! $icon !!}</div>
                    <div style="font-weight:800; font-size:1.25rem; color:var(--text-light); margin-bottom:0.2rem;">{{ $label }}</div>
                    <div style="font-size:0.95rem; color:var(--text-muted);">{{ $desc }}</div>
                </div>
            @endif
        </div>
    </div>

    {{-- Items del pedido --}}
    <div class="admin-card" style="margin-bottom:2rem; background: rgba(25, 20, 18, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.05);">
        <div class="admin-card-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); display:flex; justify-content:space-between; align-items:center;">
            <span class="admin-card-title" style="display:flex; align-items:center; gap:0.5rem;"><i class="ph ph-receipt" style="color:#E07820;"></i> Resumen del Pedido</span>
        </div>
        <div style="padding:1.5rem;">
            
            <div style="margin-bottom: 1.5rem;">
                @foreach($order->items as $item)
                <div class="order-item-card">
                    <div class="item-left">
                        <div class="item-qty">{{ $item->quantity }}</div>
                        <div class="item-info">
                            <div class="item-name">{{ $item->menuItem->name ?? '(Producto no disponible)' }}</div>
                            
                            @if($item->customizations)
                                <div class="customizations-list">
                                    @php $cust = is_string($item->customizations) ? json_decode($item->customizations, true) : $item->customizations; @endphp
                                    
                                    @if(!empty($cust['removable']))
                                        <div style="color:#ef4444;"><i class="ph ph-minus-circle"></i> Sin: {{ implode(', ', $cust['removable']) }}</div>
                                    @endif
                                    
                                    @if(!empty($cust['extras']))
                                        <div style="color:#4ade80;"><i class="ph ph-plus-circle"></i> Extra: 
                                            @foreach($cust['extras'] as $ext)
                                                {{ $ext['name'] }} (+${{ number_format((float)($ext['price']??0)/1000, 1) }}K){{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="item-price">
                        @php $s = $item->subtotal; @endphp
                        ${{ $s >= 1000 ? number_format($s/1000,1).'K' : number_format($s,0) }}
                    </div>
                </div>
                @endforeach
            </div>
            
            <div style="border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 1.5rem;">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.5rem; color:var(--text-muted);">
                    <span>Subtotal</span>
                    <span>${{ number_format($order->total - $order->delivery_fee, 0) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:1rem; color:var(--text-muted);">
                    <span>Domicilio</span>
                    <span>${{ number_format($order->delivery_fee, 0) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; padding-top:1rem; border-top: 1px solid rgba(255,255,255,0.05);">
                    <span style="font-size:1.2rem; font-weight:700; color:#F2E8D5;">Total a pagar</span>
                    <span style="font-size:1.5rem; font-weight:900; color:#E07820;">{{ $order->total_formatted }}</span>
                </div>
            </div>
            
        </div>
    </div>

    {{-- Info Adicional --}}
    @if($order->address || $order->notes)
    <div class="admin-card" style="margin-bottom:2rem; background: rgba(25, 20, 18, 0.6); border: 1px solid rgba(255,255,255,0.05);">
        <div class="admin-card-header" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
            <span class="admin-card-title" style="display:flex; align-items:center; gap:0.5rem;"><i class="ph ph-info" style="color:#E07820;"></i> Información de entrega</span>
        </div>
        <div class="admin-card-body" style="padding:1.5rem;">
            @if($order->address)
                <div style="display:flex; gap:1rem; margin-bottom:1rem; align-items:flex-start;">
                    <div style="background:rgba(255,255,255,0.05); width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#E07820;"><i class="ph ph-house" style="font-size:1.2rem;"></i></div>
                    <div>
                        <div style="font-size:0.8rem; text-transform:uppercase; color:var(--text-muted); font-weight:700; letter-spacing:1px; margin-bottom:0.2rem;">Dirección</div>
                        <div style="color:var(--text-light); font-weight:500;">{{ $order->address }}</div>
                    </div>
                </div>
            @endif
            @if($order->notes)
                <div style="display:flex; gap:1rem; align-items:flex-start;">
                    <div style="background:rgba(255,255,255,0.05); width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#E07820;"><i class="ph ph-chat-text" style="font-size:1.2rem;"></i></div>
                    <div>
                        <div style="font-size:0.8rem; text-transform:uppercase; color:var(--text-muted); font-weight:700; letter-spacing:1px; margin-bottom:0.2rem;">Notas especiales</div>
                        <div style="color:var(--text-light); font-weight:500; font-style:italic;">"{{ $order->notes }}"</div>
                    </div>
                </div>
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
