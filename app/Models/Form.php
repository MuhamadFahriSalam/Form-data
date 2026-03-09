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

    // Tambahkan relasi untuk submissions
    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

