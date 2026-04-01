<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\QuizOption;

class Play extends Component
{
    public $quiz;
    public $answers = [];
    public $currentQuestion = 0;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.options');

        foreach ($this->quiz->questions as $q) {
            if ($q->is_multiple) {
                $this->answers[$q->id] = [];
            } else {
                $this->answers[$q->id] = null;
            }
        }
    }

    // NEXT
    public function next()
    {
        if ($this->currentQuestion < count($this->quiz->questions) - 1) {
            $this->currentQuestion++;
        }
    }

    // PREV
    public function prev()
    {
        if ($this->currentQuestion > 0) {
            $this->currentQuestion--;
        }
    }

    // 🔥 Checkbox hanya 1 pilihan
    public function selectSingleCheckbox($questionId, $optionId)
    {
        $this->answers[$questionId] = [];
        $this->answers[$questionId][$optionId] = 1;
    }

    // SUBMIT
    public function submit()
    {
        $userId = auth()->id();

        $attempt = QuizAttempt::create([
            'user_id' => $userId,
            'quiz_id' => $this->quiz->id,
            'score' => 0
        ]);

        $score = 0;

        foreach ($this->answers as $questionId => $answer) {

            // SINGLE
            if (!is_array($answer)) {
                $option = QuizOption::find($answer);

                if ($option) {
                    QuizAnswer::create([
                        'attempt_id' => $attempt->id,
                        'question_id' => $questionId,
                        'option_id' => $option->id,
                        'is_correct' => $option->is_correct
                    ]);

                    if ($option->is_correct) {
                        $score++;
                    }
                }
            }

            // CHECKBOX (1 pilihan)
            else {
                foreach ($answer as $optionId => $val) {
                    if ($val) {
                        $option = QuizOption::find($optionId);

                        QuizAnswer::create([
                            'attempt_id' => $attempt->id,
                            'question_id' => $questionId,
                            'option_id' => $option->id,
                            'is_correct' => $option->is_correct
                        ]);

                        if ($option->is_correct) {
                            $score++;
                        }
                    }
                }
            }
        }

        $attempt->update([
            'score' => $score
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Quiz selesai! Score: ' . $score);
    }

    public function render()
    {
        return view('livewire.quiz.play')
            ->layout('layouts.app');
    }
}