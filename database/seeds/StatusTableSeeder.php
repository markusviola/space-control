<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['問い合わせ', '仮予約', '本予約', 'キャンセル'];
        foreach($statuses as $status) {
            Status::create([
                'name' => $status,
            ]);
        }
    }
}
