<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmployeeField extends Model
{
    protected $fillable = [
        'key','label','type','required','options','sort_order','is_active'
    ];

    protected $casts = [
        'required' => 'boolean',
        'is_active' => 'boolean',
        'options' => 'array',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(EmployeeFieldValue::class, 'field_id');
    }
}