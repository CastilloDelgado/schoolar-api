<?php

use Illuminate\Database\Seeder;

class AvisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Aviso::class, 5)->create();
    }
}
