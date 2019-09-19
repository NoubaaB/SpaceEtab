<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Passage;
use Faker\Generator as Faker;

$factory->define(Passage::class, function (Faker $faker) {
    static $counteur=1;
    return [
        'stagiaire_id'=>$counteur++,
    ];
});
