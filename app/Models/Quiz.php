<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'type',
        'time_limit',
        'is_published',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()     
    {
        return $this->hasMany(Question::class);
    }
    
}
