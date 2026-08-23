<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_name',
        'company_name',
        'phone',
        'email',
        'service_interested',
        'estimated_quantity',
        'message',
        'is_read',
        'status',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}
