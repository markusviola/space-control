<?php

use App\Discovery;
use Illuminate\Database\Seeder;

class DiscoveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discoveries = ['スペースマーケット', '東京ロケーションボックス', '奥多摩日本語学校HP'];
        foreach($discoveries as $discovery) {
            Discovery::create([
                'name' => $discovery,
            ]);
        }
    }
}
