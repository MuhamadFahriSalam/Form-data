<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    protected $fillable = ['title', 'uuid'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quiz) {
            if (!$quiz->uuid) {
                $quiz->uuid = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}