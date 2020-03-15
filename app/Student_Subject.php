<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Subject extends Model
{
    protected $table = "student__subject";
    protected $fillable = [
        "student_id",
        "subject_id"
    ];

    public function student()
    {
        return $this->belongsTo('App\Student' );
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject' );
    }

    public function qualification()
    {
        return $this->hasOneThrough('App\Qualification','App\Student');
    }
}
