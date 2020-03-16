<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        "docket",
        "person_id"
    ];

    protected $casts = [
        'docket' => 'integer',
        'person_id' => 'integer'
    ];

    public function person()
    {
        return $this->belongsTo('App\Person' );
    }

    public function name()
    {
        return $this->person->full_name();
    }
}
