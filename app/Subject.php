<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        "name",
        "description",
        "teacher_id"
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher' );
    }
}
