@extends('layouts.admin')
@section('page-title', 'Pedidos')
@section('page-subtitle', 'Gestiona y actualiza el estado de todos los pedidos')

@section('content')

{{-- Filtros por estado --}}
<div style="display:flex; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap;">
    @foreach(['all'=>'Todos', 'pending'=>'⏳ Pendientes', 'preparing'=>'🔥 En Preparación', 'on_way'=>'🚀 En Camino', 'delivered'=>'✅ Entregados'] as $key => $label)
        <a href="{{ route('admin.orders.index', ['status'=>$key]) }}"
           class="btn btn-sm {{ $status === $key ? 'btn-primary' : 'btn-ghost' }}">
            {{ $label }}
            <span style="background:rgba(255,255,255,0.15); padding:1px 6px; border-radius:10px; font-size:0.72rem;">
                {{ $counts[$key] }}
            </span>
        </a>
    @endforeach
</div>

<div class="admin-card">
    <div style="overflow-x:auto;">
        @if($orders->isEmpty())
            <div style="padding:3rem; text-align:center; color:var(--text-muted);">
                <div style="font-size:4rem; margin-bottom:1rem;">📭</div>
                <p>No hay pedidos con este filtro.</p>
            </div>
        @else
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td style="color:var(--text-muted); font-weight:600;">#{{ $order->id }}</td>
                        <td>
                            <div style="font-weight:700; color:var(--text-light);">{{ $order->user->name }}</div>
                            <div style="font-size:0.75rem; color:var(--text-muted);">{{ $order->user->email }}</div>
                        </td>
                        <td style="color:var(--text-mid);">{{ $order->items->sum('quantity') }} item(s)</td>
                        <td style="color:var(--primary-light); font-weight:700;">{{ $order->total_formatted }}</td>
                        <td>
                            {{-- Cambio rápido de estado --}}
                            <form method="POST" action="{{ route('admin.orders.status', $order) }}" id="status-form-{{ $order->id }}">
                                @csrf @method('PATCH')
                                <select name="status"
                                    onchange="document.getElementById('status-form-{{ $order->id }}').submit()"
                                    style="background:var(--bg-elevated); border:1px solid var(--border); color:var(--text-light); padding:0.35rem 0.6rem; border-radius:8px; font-size:0.8rem; cursor:pointer; font-family:'Poppins',sans-serif;">
                                    <option value="pending"   {{ $order->status === 'pending'   ? 'selected' : '' }}>⏳ Pendiente</option>
                                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>🔥 En Preparación</option>
                                    <option value="on_way"    {{ $order->status === 'on_way'    ? 'selected' : '' }}>🚀 En Camino</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>✅ Entregado</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size:0.8rem; color:var(--text-muted);">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-ghost btn-sm">👁️ Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="padding:1rem 1.5rem;">
                {{ $orders->appends(['status' => $status])->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
