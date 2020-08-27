<?php

use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /* factory(App\Pedido::class, 5)->create()->each(function ($pedido) {
          $pedido->Productos()->saveMany(factory(App\ProdServPedido::class, 2)->make()->each(function ($prodServPedido) {
          $prodServPedido->Producto()->save(factory(App\ProdServ::class)->make());
          })
          );
          }); */
        factory(App\Pedido::class, 5)->create()->each(function($pedido) {
            $pedido->Productos()->saveMany(factory(App\ProdServPedido::class, 2)->make());
        });
    }

}
