<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    // Mass assignment
    protected $fillable = [
        'title',
        'uuid',
        'description',
        'start_at',
        'end_at'
    ];

    // Auto-generate UUID saat membuat quiz baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quiz) {
            if (!$quiz->uuid) {
                $quiz->uuid = (string) Str::uuid();
            }
        });
    }

    // Relasi dengan QuizAttempt
    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Gunakan UUID untuk route model binding
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // Relasi dengan QuizQuestion
    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}