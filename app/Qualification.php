<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = "qualifications";

    protected $fillable = [
        "studentsubject_id",
        "type_id",
        "date",
        "note"
    ];

    public function studentsubject()
    {
        return $this->belongsTo('App\Student_Subject' );
    }

    public function type()
    {
        return $this->belongsTo('App\TypeQualification' );
    }

    public function student()
    {
        return $this->studentsubject->student->name();
    }

    public function subject()
    {
        return $this->studentsubject->subject->name;
    }

    public function teacher()
    {
        return $this->studentsubject->subject->teacher->name();
    }
}
