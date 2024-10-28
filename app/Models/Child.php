<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
   
    protected $fillable = ['name', 'dob', 'parent_id', 'class_id'];

    // Assuming you have a relationship to the Parent model
    public function parent()
    {
        return $this->belongsTo(Parent::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    // Assuming you have a relationship to the Class model
    public function enrolledClass()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'class_enrollments', 'child_id', 'class_id');
    }
}
