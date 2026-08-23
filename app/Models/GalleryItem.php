<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image_path',
        'description',
        'display_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public const CATEGORIES = [
        'Diamond Work',
        'Hotfix / Stone Work',
        'Lace Patti / Border Work',
        'Saree Work',
        'Workshop',
        'Office',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderByDesc('id');
    }
}
