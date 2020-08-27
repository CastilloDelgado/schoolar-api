<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Pedido;
use Faker\Generator as Faker;

$factory->define(pedido::class, function (Faker $faker) {
    return [
        'id_usuario' => 1,
        'id_factura' => null,
        'id_forma_pago' => 1,
        'status' => 1,
        'total' => $faker->numberBetween(0, 10000),
        'descuento' => 0
    ];
});

