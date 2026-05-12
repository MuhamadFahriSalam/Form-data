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
        'end_at',
        'status',
    ];

    // Aksesor untuk status quiz
    public function getIsPublishedAttribute()
    {
        return $this->status === 'published';
    }

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

    // Scope untuk quiz yang sedang aktif
    public function scopeActive($query)
    {
        return $query
            ->where(function ($q) {
                $q->whereNull('start_at')
                ->orWhere('start_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_at')
                ->orWhere('end_at', '>=', now());
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