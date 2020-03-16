<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "persons";

    protected $fillable = [
        "id_number",
        "name",
        "last_name",
        "date_birth"
    ];

    protected $casts = [
        'id_number' => 'integer',
        'name' => 'string',
        'last_name' => 'string',
        'date_birth' => 'date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function full_name()
    {
        return "{$this->name} {$this->last_name}";
    }
}
