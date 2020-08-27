<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Information;
use Faker\Generator as Faker;

$factory->define(Information::class, function (Faker $faker) {
    $randomId = $faker->unique()->numberBetween(1, 560);
    return [
        'nombre' => $faker->firstName(),
        'segundo_nombre' => $faker->firstName(),
        'apellido_paterno' => $faker->lastName(),
        'apellido_materno' =>  $faker->lastName(),
        'fecha_de_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email' => $faker->unique()->safeEmail,
        'pais_de_origen' => $faker->country(),
        'ciudad_de_origen' => $faker->city(),
        'user_id' => $randomId,
        'grupo_id' => $faker->numberBetween(1, 18),
        'emergency_information_id' => $randomId
    ];
});
