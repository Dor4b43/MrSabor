@extends('layouts.admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumen general de Mr. Sabor Burgers')

@section('content')

<div class="stat-grid" style="margin-bottom:2rem;">
    <div class="stat-card orange">
        <div class="stat-icon">🍔</div>
        <div class="stat-value">{{ $stats['total_items'] }}</div>
        <div class="stat-label">Productos en menú</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon">📦</div>
        <div class="stat-value">{{ $stats['total_orders'] }}</div>
        <div class="stat-label">Pedidos totales</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">👥</div>
        <div class="stat-value">{{ $stats['total_clients'] }}</div>
        <div class="stat-label">Clientes registrados</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon">🔥</div>
        <div class="stat-value">{{ $stats['pending_orders'] }}</div>
        <div class="stat-label">Pedidos activos</div>
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
                <div style="padding:2rem; text-align:center; color:var(--text-muted);">
                    <div style="font-size:3rem; margin-bottom:0.75rem;">📭</div>
                    <p>Aún no hay pedidos registrados.</p>
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

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-top:1.5rem;">
    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">⚡ Acciones rápidas</span>
        </div>
        <div class="admin-card-body" style="display:flex; flex-direction:column; gap:0.75rem;">
            <a href="{{ route('admin.menu-items.create') }}" class="btn btn-primary">
                ➕ Añadir nuevo producto
            </a>
            <a href="{{ route('admin.orders.index', ['status'=>'pending']) }}" class="btn btn-ghost">
                ⏳ Ver pedidos pendientes
            </a>
            <a href="{{ route('admin.orders.index', ['status'=>'preparing']) }}" class="btn btn-ghost">
                🔥 Ver pedidos en preparación
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <span class="admin-card-title">🔐 Credenciales de prueba</span>
        </div>
        <div class="admin-card-body">
            <div style="margin-bottom:1rem; padding:1rem; background:rgba(224,120,32,0.07); border-radius:10px; border:1px solid rgba(224,120,32,0.15);">
                <div style="font-size:0.75rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem;">👑 Administrador</div>
                <div style="font-size:0.88rem; color:var(--text-light);">📧 admin@mrsabor.com</div>
                <div style="font-size:0.88rem; color:var(--text-mid);">🔑 Admin123!</div>
            </div>
            <div style="padding:1rem; background:rgba(255,255,255,0.04); border-radius:10px; border:1px solid var(--border);">
                <div style="font-size:0.75rem; color:var(--text-muted); font-weight:700; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:0.4rem;">👤 Cliente de prueba</div>
                <div style="font-size:0.88rem; color:var(--text-light);">📧 cliente@mrsabor.com</div>
                <div style="font-size:0.88rem; color:var(--text-mid);">🔑 Cliente123!</div>
            </div>
        </div>
    </div>
</div>

@endsection
