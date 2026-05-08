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
            <span class="admin-card-title">📦 Pedidos Recientes</span>
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
                                <span class="badge badge-{{ $order->status_color }}">
                                    {{ $order->status_icon }} {{ $order->status_label }}
                                </span>
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

@endsection
