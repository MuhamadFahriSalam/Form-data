<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    // Mass assignment
    protected $guarded = ['id'];

    // Cast tanggal_masuk ke format date
    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    // Relasi dengan User (1-1)
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'npk', 'npk');
    }

}
