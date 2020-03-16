<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        "docket",//legajo
        "date",//fecha de ingreso
        "person_id"
    ];

    protected $casts = [
        'docket' => 'integer',
        'date' => 'date',
        'person_id' => 'integer'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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
