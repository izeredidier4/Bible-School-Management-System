<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassEnrollment extends Model
{
    use HasFactory;
    protected $fillable = ['class_id', 'child_id', 'status'];
    public $timestamps = true;

    // Define the relationship between ClassEnrollment and Classe (Class model)
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'class_id');
    }

    // Define the relationship between ClassEnrollment and Child (assuming you have a Child model)
    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }
    
}
