<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'display_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'step_number' => 'integer',
            'display_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('step_number');
    }
}
