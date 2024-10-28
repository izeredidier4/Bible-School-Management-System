<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    // app/Models/Attendance.php

    protected $fillable = ['child_id', 'date', 'status'];

    // Define the relationship with the Child model
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}


