@extends('layouts.admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumen general de Mr. Sabor Burgers')

@section('content')

<div class="stat-grid" style="margin-bottom:2rem;">
    <div class="stat-card" style="background:var(--bg-card); border:1px solid var(--border); box-shadow:0 4px 15px rgba(0,0,0,0.2);">
        <div class="stat-icon" style="color:var(--primary-light); font-size:2rem; background:rgba(224,120,32,0.1); width:50px; height:50px; display:flex; align-items:center; justify-content:center; border-radius:12px;"><i class="ph ph-hamburger"></i></div>
        <div class="stat-value" style="font-size:1.8rem; margin-top:0.5rem;">{{ $stats['total_items'] }}</div>
        <div class="stat-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Productos</div>
    </div>
    <div class="stat-card" style="background:var(--bg-card); border:1px solid var(--border); box-shadow:0 4px 15px rgba(0,0,0,0.2);">
        <div class="stat-icon" style="color:#e8b84a; font-size:2rem; background:rgba(232,184,74,0.1); width:50px; height:50px; display:flex; align-items:center; justify-content:center; border-radius:12px;"><i class="ph ph-package"></i></div>
        <div class="stat-value" style="font-size:1.8rem; margin-top:0.5rem;">{{ $stats['total_orders'] }}</div>
        <div class="stat-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Pedidos</div>
    </div>
    <div class="stat-card" style="background:var(--bg-card); border:1px solid var(--border); box-shadow:0 4px 15px rgba(0,0,0,0.2);">
        <div class="stat-icon" style="color:#86efac; font-size:2rem; background:rgba(134,239,172,0.1); width:50px; height:50px; display:flex; align-items:center; justify-content:center; border-radius:12px;"><i class="ph ph-users"></i></div>
        <div class="stat-value" style="font-size:1.8rem; margin-top:0.5rem;">{{ $stats['total_clients'] }}</div>
        <div class="stat-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Clientes</div>
    </div>
    <div class="stat-card" style="background:var(--bg-card); border:1px solid var(--border); box-shadow:0 4px 15px rgba(0,0,0,0.2);">
        <div class="stat-icon" style="color:#fca5a5; font-size:2rem; background:rgba(252,165,165,0.1); width:50px; height:50px; display:flex; align-items:center; justify-content:center; border-radius:12px;"><i class="ph ph-activity"></i></div>
        <div class="stat-value" style="font-size:1.8rem; margin-top:0.5rem;">{{ $stats['pending_orders'] }}</div>
        <div class="stat-label" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Activos</div>
    </div>
</div>

{{-- KPIs de Productos --}}
<div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:1.5rem; margin-bottom:2rem;">
    <div class="admin-card" style="border-left: 4px solid var(--primary);">
        <div class="admin-card-body">
            <div style="color:var(--text-muted); font-size:0.75rem; text-transform:uppercase; font-weight:700; letter-spacing:1px; margin-bottom:0.5rem;"><i class="ph ph-trend-up"></i> Producto más vendido</div>
            @if($mostSold)
                <div style="font-size:1.1rem; color:var(--text-light); font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $mostSold->name }}</div>
                <div style="font-size:0.85rem; color:var(--primary-light); margin-top:0.25rem;">{{ $mostSold->total_sold }} unidades vendidas</div>
            @else
                <div style="color:var(--text-muted); font-style:italic;">No hay datos aún</div>
            @endif
        </div>
    </div>
    
    <div class="admin-card" style="border-left: 4px solid #fca5a5;">
        <div class="admin-card-body">
            <div style="color:var(--text-muted); font-size:0.75rem; text-transform:uppercase; font-weight:700; letter-spacing:1px; margin-bottom:0.5rem;"><i class="ph ph-trend-down"></i> Producto menos vendido</div>
            @if($leastSold)
                <div style="font-size:1.1rem; color:var(--text-light); font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $leastSold->name }}</div>
                <div style="font-size:0.85rem; color:#fca5a5; margin-top:0.25rem;">Solo {{ $leastSold->total_sold }} unidades vendidas</div>
            @else
                <div style="color:var(--text-muted); font-style:italic;">No hay datos aún</div>
            @endif
        </div>
    </div>
    
    <div class="admin-card" style="border-left: 4px solid #93c5fd;">
        <div class="admin-card-body">
            <div style="color:var(--text-muted); font-size:0.75rem; text-transform:uppercase; font-weight:700; letter-spacing:1px; margin-bottom:0.5rem;"><i class="ph ph-eye"></i> Más interactuado (vistas)</div>
            @if($mostViewed && $mostViewed->views_count > 0)
                <div style="font-size:1.1rem; color:var(--text-light); font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $mostViewed->name }}</div>
                <div style="font-size:0.85rem; color:#93c5fd; margin-top:0.25rem;">{{ $mostViewed->views_count }} interacciones de clientes</div>
            @else
                <div style="color:var(--text-muted); font-style:italic;">No hay datos aún</div>
            @endif
        </div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">

    {{-- Pedidos recientes --}}
    <div class="admin-card" style="grid-column:1 / -1;">
        <div class="admin-card-header">
            <span class="admin-card-title"><i class="ph ph-package" style="margin-right:6px; color:var(--primary-light);"></i> Pedidos Recientes</span>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm">Ver todos</a>
        </div>
        <div style="overflow-x:auto;">
            @if($recent_orders->isEmpty())
                <div style="padding:4rem 2rem; text-align:center; color:var(--text-muted);">
                    <div style="font-size:4rem; margin-bottom:1rem; opacity:0.5;"><i class="ph ph-mailbox"></i></div>
                    <p style="font-size:1.1rem;">Aún no hay pedidos registrados.</p>
                </div>
            @else
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_orders as $order)
                        <tr>
                            <td style="color:var(--text-muted);">#{{ $order->id }}</td>
                            <td style="color:var(--text-light); font-weight:600;">{{ $order->user->name }}</td>
                            <td>
                                <select onchange="updateOrderStatus({{ $order->id }}, this.value, this)"
                                        style="background:var(--bg-elevated); border:1px solid var(--border); color:var(--text-light); padding:0.25rem 0.5rem; border-radius:6px; font-size:0.75rem; cursor:pointer; font-family:'Poppins',sans-serif;">
                                    <option value="pending_payment" {{ $order->status === 'pending_payment' ? 'selected' : '' }}>Pend. Pago</option>
                                    <option value="pending"   {{ $order->status === 'pending'   ? 'selected' : '' }}>Pendiente</option>
                                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>En Preparación</option>
                                    <option value="on_way"    {{ $order->status === 'on_way'    ? 'selected' : '' }}>En Camino</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Entregado</option>
                                </select>
                                <span id="status-spinner-{{ $order->id }}" style="display:none; font-size:12px; margin-left:4px;"><i class="ph ph-spinner ph-spin"></i></span>
                            </td>
                            <td style="color:var(--primary-light); font-weight:700;">{{ $order->total_formatted }}</td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-ghost btn-sm">Ver</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>

<div style="margin-top:1.5rem;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title"><i class="ph ph-lightning"></i> Acciones rápidas</span>
        </div>
        <div class="admin-card-body" style="display:flex; gap:1rem;">
            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary" style="flex:1;">
                <i class="ph ph-plus-circle"></i> Añadir nuevo producto
            </a>
            <a href="{{ route('admin.orders.index', ['status'=>'pending']) }}" class="btn btn-ghost" style="flex:1; border:1px solid var(--border);">
                <i class="ph ph-hourglass-high"></i> Ver pedidos pendientes
            </a>
            <a href="{{ route('admin.orders.index', ['status'=>'preparing']) }}" class="btn btn-ghost" style="flex:1; border:1px solid var(--border);">
                <i class="ph ph-cooking-pot"></i> Ver pedidos en preparación
            </a>
        </div>
    </div>
</div>

<script>
    // 1. CAMBIO RÁPIDO DE ESTADO VÍA AJAX
    function updateOrderStatus(orderId, status, selectElement) {
        const spinner = document.getElementById('status-spinner-' + orderId);
        spinner.style.display = 'inline-block';
        selectElement.disabled = true;

        fetch(`/admin/orders/${orderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            spinner.style.display = 'none';
            selectElement.disabled = false;
            if (data.success) {
                // Podríamos cambiar un badge si existiera, pero ahora es un select
                // Efecto visual de éxito
                selectElement.style.borderColor = '#4ade80';
                setTimeout(() => selectElement.style.borderColor = 'var(--border)', 1500);
            }
        })
        .catch(error => {
            spinner.style.display = 'none';
            selectElement.disabled = false;
            alert('Error al actualizar el estado.');
        });
    }

    // 2. NOTIFICACIONES SONORAS (POLLING)
    // Usaremos Web Audio API para generar un "Ding" de campana sin necesidad de archivos externos
    function playDingSound() {
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        
        // Oscilador 1: Tono principal (campana aguda)
        const osc1 = audioCtx.createOscillator();
        const gain1 = audioCtx.createGain();
        osc1.type = 'sine';
        osc1.frequency.setValueAtTime(880, audioCtx.currentTime); // A5
        gain1.gain.setValueAtTime(0.5, audioCtx.currentTime);
        gain1.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 1.5);
        osc1.connect(gain1);
        gain1.connect(audioCtx.destination);
        
        // Oscilador 2: Armónico
        const osc2 = audioCtx.createOscillator();
        const gain2 = audioCtx.createGain();
        osc2.type = 'sine';
        osc2.frequency.setValueAtTime(1760, audioCtx.currentTime); // A6
        gain2.gain.setValueAtTime(0.2, audioCtx.currentTime);
        gain2.gain.exponentialRampToValueAtTime(0.01, audioCtx.currentTime + 1);
        osc2.connect(gain2);
        gain2.connect(audioCtx.destination);

        osc1.start(); osc1.stop(audioCtx.currentTime + 1.5);
        osc2.start(); osc2.stop(audioCtx.currentTime + 1);
    }

    let lastOrderId = {{ $recent_orders->first()->id ?? 'null' }};
    
    // Revisar cada 15 segundos
    setInterval(() => {
        fetch('/admin/api/pending-orders')
            .then(res => res.json())
            .then(data => {
                if (data.latest_id && lastOrderId !== null && data.latest_id > lastOrderId) {
                    playDingSound();
                    lastOrderId = data.latest_id;
                    
                    // Notificación en pantalla o recarga suave
                    // Recargamos la página para que el administrador vea el nuevo pedido
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            })
            .catch(err => console.error('Error verificando pedidos', err));
    }, 15000);
</script>

@endsection
