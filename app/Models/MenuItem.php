<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'image_path', 'category', 'category_id', 'is_available', 'customizations'];

    protected $casts = [
        'price'          => 'decimal:2',
        'is_available'   => 'boolean',
        'customizations' => 'array',
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

    /**
     * Resuelve la URL de la imagen.
     * - Si empieza con "direct:", usa la ruta pública directa.
     * - Si no, usa Storage::url() (archivos subidos via admin).
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }
        if (str_starts_with($this->image_path, 'direct:')) {
            return substr($this->image_path, 7); // quita "direct:"
        }
        return \Illuminate\Support\Facades\Storage::url($this->image_path);
    }
}

