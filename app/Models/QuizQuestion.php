<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'quiz_id',
        'question',
        'image',
        'is_multiple'
    ];

    // Relasi dengan Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Relasi dengan QuizOption
    public function options()
    {
        return $this->hasMany(QuizOption::class, 'question_id');
    }
}