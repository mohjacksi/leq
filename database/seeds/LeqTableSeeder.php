<?php

use App\Models\Leq;
use Illuminate\Database\Seeder;

class LeqTableSeeder extends Seeder
{
    public function run()
    {
        $leq = [
            [
                'name'             => '8',
                'leq_code'           => '8',
                'layene_siyasi_id' => 1,
            ],
        ];

        Leq::insert($leq);
    }
}
