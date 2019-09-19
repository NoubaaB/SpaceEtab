<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stagiaire;
use Faker\Generator as Faker;

$factory->define(Stagiaire::class, function (Faker $faker) {
    static $counteur=2;
    return [
        "heures_absence"=>$faker->numberBetween($min = 0, $max = 80),
        'user_id'=> $counteur++,
        'filiere_id'=>1,
    ];
});
