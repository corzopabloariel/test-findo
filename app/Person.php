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
}
