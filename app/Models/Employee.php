<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = [
        'nik','nama','email','no_hp','jabatan','departemen',
        'tanggal_masuk','status','alamat'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function fieldValues(): HasMany
    {
        return $this->hasMany(EmployeeFieldValue::class);
    }
}