<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $fillable = [
        'attempt_id',
        'question_id',
        'option_id',
        'is_correct'
    ];

    // Relasi dengan QuizAttempt
    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    // Relasi dengan QuizQuestion
    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    // Relasi dengan QuizOption
    public function option()
    {
        return $this->belongsTo(QuizOption::class);
    }
}

