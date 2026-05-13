<x-app-layout>
<div class="dashboard-content">

    <div class="welcome-card" style="margin-bottom:2rem;">
        <div class="welcome-avatar"><i class="ph ph-package" style="color: white;"></i></div>
        <div class="welcome-text">
            <h2>Mis Pedidos</h2>
            <p>Historial y seguimiento de todos tus pedidos.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-ghost btn-sm" style="margin-left:auto;"><i class="ph ph-arrow-left"></i> Volver al menú</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom:1.5rem;"><i class="ph ph-check-circle"></i> {{ session('success') }}</div>
        <script>
            // Si llegamos aquí con un éxito, limpiamos el carrito
            try { sessionStorage.removeItem('mrsabor_cart'); } catch(e) {}
        </script>
    @endif

    @if($orders->isEmpty())
        <div style="text-align:center; padding:4rem 2rem; color:var(--text-muted);">
            <div style="font-size:5rem; margin-bottom:1rem;"><i class="ph ph-shopping-bag"></i></div>
            <h3 style="font-size:1.3rem; color:var(--text-light); margin-bottom:0.5rem;">Aún no tienes pedidos</h3>
            <p style="margin-bottom:1.5rem;">¡Explora el menú y haz tu primer pedido!</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Ver menú <i class="ph ph-fire"></i></a>
        </div>
    @else
        <div style="display:flex; flex-direction:column; gap:1rem;">
            @foreach($orders as $order)
            <a href="{{ route('orders.show', $order) }}"
               style="text-decoration:none; background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); padding:1.25rem 1.5rem;
                      display:flex; align-items:center; justify-content:space-between; gap:1rem; transition:all 0.3s;"
               onmouseover="this.style.borderColor='rgba(224,120,32,0.3)'; this.style.transform='translateY(-2px)'"
               onmouseout="this.style.borderColor=''; this.style.transform=''">
                <div style="display:flex; align-items:center; gap:1.25rem;">
                    <div style="width:48px; height:48px; background:rgba(224,120,32,0.1); border:1px solid rgba(224,120,32,0.2);
                                border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; flex-shrink:0;">
                        <i class="ph ph-{{ $order->status_icon }}" style="color:var(--primary-light);"></i>
                    </div>
                    <div>
                        <div style="font-weight:700; color:var(--text-light);">Pedido #{{ $order->id }}</div>
                        <div style="font-size:0.8rem; color:var(--text-muted);">
                            {{ $order->items->sum('quantity') }} item(s) · {{ $order->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:1.25rem;">
                    <span style="font-size:1.1rem; font-weight:800; color:var(--primary-light);">{{ $order->total_formatted }}</span>
                    <span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span>
                    <span style="color:var(--text-muted);"><i class="ph ph-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:1.5rem;">{{ $orders->links() }}</div>
    @endif

</div>
</x-app-layout>
