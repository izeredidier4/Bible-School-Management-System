<?php

// app/Models/Answer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['child_id','quiz_id',  'question_id', 'user_answer', 'is_correct'];

    // Define the relationship with the Child model
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    // Define the relationship with the Quiz model

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
    // Define the relationship with the Question model
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

   
}

