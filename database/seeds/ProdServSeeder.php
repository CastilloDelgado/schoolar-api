<?php

use Illuminate\Database\Seeder;

class ProdServSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\ProdServ::class, 10)->create();
    }

}
