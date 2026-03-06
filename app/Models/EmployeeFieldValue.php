<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeFieldValue extends Model
{
    protected $fillable = ['employee_id','field_id','value'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(EmployeeField::class, 'field_id');
    }
}