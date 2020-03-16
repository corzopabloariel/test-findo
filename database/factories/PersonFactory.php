<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'id_number' => $faker->randomElement(App\Person::pluck('id', 'id')->toArray()),
        'name' => $faker->firstName,
        'last_name' => Str::random(90),
        'date_birth' => "2019-03-10"
    ];
});
