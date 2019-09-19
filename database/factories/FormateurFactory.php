<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Formateur;
use Faker\Generator as Faker;

$factory->define(Formateur::class, function (Faker $faker,$params) {
    static $counteur=1;
    return [
        'user_id'=> $counteur++,
        "nom_module"=>$params['nom_module'],
    ];
});
