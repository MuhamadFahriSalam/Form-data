<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormQuestion extends Model
{
    protected $fillable = [
        'form_id',
        'question',
        'type',
        'is_required',
        'options',
        'sort_order',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'options' => 'array',
    ];

    // Relasi ke form induk
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    // Tambahkan relasi untuk jawaban- jawaban yang diberikan untuk pertanyaan ini
    public function answers(): HasMany
    {
        return $this->hasMany(FormAnswer::class);
    }
}