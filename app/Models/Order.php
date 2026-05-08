<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'status', 'total', 'notes', 'address', 'address_id', 'delivery_fee', 'payment_method', 'payment_receipt_path', 'order_type'];

    const STATUS_LABELS = [
        'pending_payment' => 'Pendiente de Pago',
        'pending'   => 'Pendiente',
        'preparing' => 'En Preparación',
        'on_way'    => 'En Camino',
        'delivered' => 'Entregado',
        'cancelled' => 'Cancelado',
    ];

    const STATUS_COLORS = [
        'pending_payment' => 'gray',
        'pending'   => 'amber',
        'preparing' => 'orange',
        'on_way'    => 'blue',
        'delivered' => 'green',
        'cancelled' => 'red',
    ];

    const STATUS_ICONS = [
        'pending_payment' => '💳',
        'pending'   => '⏳',
        'preparing' => '🔥',
        'on_way'    => '🚀',
        'delivered' => '✅',
        'cancelled' => '🚫',
    ];

    const STATUS_FLOW = ['pending_payment', 'pending', 'preparing', 'on_way', 'delivered'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userAddress()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'amber';
    }

    public function getStatusIconAttribute(): string
    {
        return self::STATUS_ICONS[$this->status] ?? '⏳';
    }

    public function getStatusIndexAttribute(): int
    {
        return array_search($this->status, self::STATUS_FLOW) ?: 0;
    }

    public function getTotalFormattedAttribute(): string
    {
        $val = (float) $this->total;
        if ($val >= 1000) {
            return '$' . number_format($val / 1000, 1) . 'K';
        }
        return '$' . number_format($val, 0);
    }

    public function getPaymentReceiptUrlAttribute(): ?string
    {
        if (!$this->payment_receipt_path) return null;
        return \Illuminate\Support\Facades\Storage::url($this->payment_receipt_path);
    }
}
