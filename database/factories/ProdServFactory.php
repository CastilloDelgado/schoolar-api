<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ProdServ;
use Faker\Generator as Faker;

$factory->define(ProdServ::class, function (Faker $faker) {
    return [
        'status' => 1,
        'codigo' => $faker->randomLetter,
        'nombre' => $faker->title(1, 10000),
        'descripcion' => $faker->text(10),
        'monto' => $faker->numberBetween(1, 10000),
        'tipo_monto' => 1,
        'clave_sat' => $faker->randomLetter,
        'clave_producto' => $faker->randomLetter
    ];
});
