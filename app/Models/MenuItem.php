<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image_path', 'category', 'category_id', 'is_available'];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function menuCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getPriceFormattedAttribute(): string
    {
        $val = (float) $this->price;
        if ($val >= 1000) {
            return '$' . number_format($val / 1000, 1) . 'K';
        }
        return '$' . number_format($val, 0);
    }
}
