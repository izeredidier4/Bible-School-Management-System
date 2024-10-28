<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'date', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->where('role', ['Teacher', 'Admin']);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_course', 'course_id', 'class_id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function quizzes()
{
    return $this->hasMany(Quiz::class, 'course_id');
}
public function class()
{
    return $this->belongsTo(Classe::class);
}

    

}
