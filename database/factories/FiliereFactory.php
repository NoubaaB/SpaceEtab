<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Filiere;
use Faker\Generator as Faker;

$factory->define(Filiere::class, function (Faker $faker,$params) {
    return [
        "nom"=>"Techniques de Développement Informatique",
        "groupe"=>"1ere Année"
    ];
});
