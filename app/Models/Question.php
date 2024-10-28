<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'options',
        'correct_answer',
    ];

    protected $casts = [
        'options' => 'array',
    ];
    

    // Define the relationship with the Quiz model
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
