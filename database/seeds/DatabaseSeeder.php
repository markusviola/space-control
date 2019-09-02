<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SpaceTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(DiscoveryTableSeeder::class);
    }
}
