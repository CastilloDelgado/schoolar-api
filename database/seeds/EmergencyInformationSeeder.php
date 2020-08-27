<?php

use Illuminate\Database\Seeder;

class EmergencyInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\EmergencyInformation::class, 560)->create();
    }
}
