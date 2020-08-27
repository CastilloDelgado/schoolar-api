<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Aviso;
use Faker\Generator as Faker;

$factory->define(Aviso::class, function (Faker $faker) {
    return [
        'titulo' => $faker->text(50),
        'texto' => $faker->text(200),
        'url_imagen' => $faker->text(50),
        'creado_por' => $faker->numberBetween(1,100),
        'actualizado_por' => $faker->numberBetween(1,100)
    ];
});
