<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Subject extends Model
{
    protected $fillable = [
        "student_id",
        "subject_id"
    ];
}
