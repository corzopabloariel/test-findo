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

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'teacher_id' => 'integer'
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher' );
    }
}
