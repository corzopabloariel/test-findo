<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = "qualifications";

    protected $fillable = [
        "student_id",
        "teacher_id",
        "subject_id",
        "date",
        "note"
    ];
}
