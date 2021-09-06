<?php

use App\Models\Layenetsiyasi;
use App\Models\Lijna;
use Illuminate\Database\Seeder;

class LayanTableSeeder extends Seeder
{
    public function run()
    {
        $Layan = [
            [
                'id' => 1,
                'name'             => 'بارتي',
                'code_siyasi'           => 'بارتي',
            ],
        ];

        Layenetsiyasi::insert($Layan);
    }
}
