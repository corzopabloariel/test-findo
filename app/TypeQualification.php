<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeQualification extends Model
{
    protected $fillable = [
        "name"
    ];

    protected $casts = [
        'name' => 'string'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
