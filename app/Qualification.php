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
}
