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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher' );
    }
}
