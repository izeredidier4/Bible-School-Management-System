<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{

        protected $fillable = ['name', 'description', 'teacher_id', 'start_date', 'end_date'];
    
        public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id');
}

public function course()
    {
        return $this->hasMany(Course::class);
    }

        public function courses()
{
    return $this->belongsToMany(Course::class, 'classe_course', 'class_id', 'course_id');
}

        public function students()
        {
            return $this->belongsToMany(User::class, 'class_student', 'class_id', 'student_id');
        }
        public function children()
        {
            return $this->belongsToMany(Child::class, 'class_child', 'class_id', 'child_id');
        }
        public function child()
        {
            // Assuming you have a 'child_id' foreign key in the 'classes' table
            return $this->belongsTo(Child::class, 'child_id');
        }

        public function enrollments()
        {
            return $this->hasMany(ClassEnrollment::class, 'class_id');
        }
}
