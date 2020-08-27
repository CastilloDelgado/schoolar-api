<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EmergencyInformation;
use Faker\Generator as Faker;

$factory->define(EmergencyInformation::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName(),
        'segundo_nombre' => $faker->firstName(),
        'apellido_paterno' => $faker->lastName(),
        'apellido_materno' => $faker->lastName(),
        'fecha_de_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email' => $faker->unique()->safeEmail,
        'pais_de_origen' => $faker->country(),
        'ciudad_de_origen' => $faker->city(),
        'calle' => $faker->word(),
        'numero' => $faker->numberBetween(1000, 9999),
        'telefono' => $faker->phoneNumber(),
        'information_id' => $faker->unique()->numberBetween(1,560)
    ];
});
