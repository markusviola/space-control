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
        $types = ['Coworking', 'Rental', 'Atelier', 'Others (企業研修・開発合宿等)'];
        foreach($types as $type) {
            Type::create([
                'name' => $type,
            ]);
        }
    }
}
