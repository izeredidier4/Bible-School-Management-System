<?php
// app/Models/Report.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'child_name',
        'age',
        'class_name',
        'course_name',
        'grade',
        'teachers_remarks',
        // Add other report-related columns here
    ];

    /**
     * Get the child associated with the report.
     */
    public function child()
    {
        return $this->belongsTo(Child::class, 'child_id');
    }

    /**
     * Get the course associated with the report.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Get the class associated with the report.
     */
    public function courseClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
