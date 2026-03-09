<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

}
