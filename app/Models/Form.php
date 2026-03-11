<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    protected $guarded = ['id'];

    // Relasi untuk pertanyaan-pertanyaan dalam form
    public function questions(): HasMany
    {
        return $this->hasMany(FormQuestion::class);
    }
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
    // Tambahkan relasi untuk submissions
    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $casts = [
        'is_active' => 'boolean',
        'opens_at' => 'datetime',
        'closes_at' => 'datetime',
    ];

    public function getStatusAttribute(): string
    {
        $now = now();

        if ($this->opens_at && $now < $this->opens_at) {
            return 'upcoming';
        }

        if ($this->closes_at && $now > $this->closes_at) {
            return 'closed';
        }

        return 'open';
    }
}

