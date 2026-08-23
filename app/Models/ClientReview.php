<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'company_name',
        'location',
        'review_text',
        'rating',
        'is_published',
        'display_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_published' => 'boolean',
            'display_order' => 'integer',
        ];
    }

    /**
     * Scope only approved/published reviews for public display.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('display_order')->orderByDesc('id');
    }
}
