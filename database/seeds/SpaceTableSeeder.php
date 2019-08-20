<?php

use App\Space;
use Illuminate\Database\Seeder;

class SpaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spaces = ['教室', '音楽室', '屋上', '昇降口'];
        foreach($spaces as $space) {
            Space::create([
                'name' => $space,
            ]);
        }
    }
}
