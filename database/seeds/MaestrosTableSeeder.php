<?php

use Illuminate\Database\Seeder;

class MaestrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Maestro::class, 500)->create();
    }
}
