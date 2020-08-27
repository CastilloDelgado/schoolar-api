<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ProdServPedido;
use Faker\Generator as Faker;

$factory->define(ProdServPedido::class, function (Faker $faker) {
    return [
        'cantidad' => $faker->numberBetween(1, 10),
        'importe' => $faker->numberBetween(1, 10000),
        'id_prod_serv' => $faker->numberBetween(1, 10),
    ];
});
