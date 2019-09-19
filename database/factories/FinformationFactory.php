<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Finformation;
use Faker\Generator as Faker;

$factory->define(Finformation::class, function (Faker $faker) {
    static $counteur=1;
    return [
        'stagiaire_id'=>$counteur++,
    ];
});
