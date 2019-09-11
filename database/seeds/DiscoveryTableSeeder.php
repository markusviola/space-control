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
        $discoveries = [
            'スコワーキング',
            'レンタル',
            'アトリエ',
            'その他'
        ];
        foreach($discoveries as $discovery) {
            Discovery::create([
                'name' => $discovery,
            ]);
        }
    }
}
