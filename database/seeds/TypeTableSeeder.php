<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['コワーキング', 'レンタル', 'アトリエ', 'その他'];
        foreach($types as $type) {
            Type::create([
                'name' => $type,
            ]);
        }
    }
}
