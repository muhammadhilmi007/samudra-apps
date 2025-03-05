<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(BaseSeeder::class);
        // $this->call(JurnalUmumSeeder::class);
        $this->call(KendaraanSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(TruckSeeder::class);
    }
}
