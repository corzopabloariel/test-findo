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

    public function full_name()
    {
        return "{$this->name} {$this->last_name}";
    }
}
