<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker,$params) {
    static $counteur=1; 
    if ( $counteur==26) {
        $counteur=1;
    }
    return [
        "nom"=>$params["nom"],
        "coefficient"=>2,
        "filiere_id"=>$params["filiere_id"],
        'stagiaire_id'=> $counteur++,
    ];
});
