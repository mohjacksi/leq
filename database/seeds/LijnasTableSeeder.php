<?php

use App\Models\Lijna;
use Illuminate\Database\Seeder;

class LijnasTableSeeder extends Seeder
{
    public function run()
    {
        $lijnas = [
            [
                'name'             => 'زاخو',
                'lijna_code'           => 'زاخو',
                'leq_id' => 1,
            ],
            [
                'name'             => 'خابور',
                'lijna_code'           => 'خابور',
                'leq_id' => 1,
            ],
            [
                'name'             => 'سةرهلدان',
                'lijna_code'           => 'سةرهلدان',
                'leq_id' => 1,
            ],
            [
                'name'             => 'كولان',
                'lijna_code'           => 'كولان',
                'leq_id' => 1,
            ],
            [
                'name'             => 'هيزل',
                'lijna_code'           => 'هيزل',
                'leq_id' => 1,
            ],
            [
                'name'             => 'دةركار',
                'lijna_code'           => 'دةركار',
                'leq_id' => 1,
            ],
            [
                'name'             => 'باتيفا',
                'lijna_code'           => 'باتيفا',
                'leq_id' => 1,
            ],
            [
                'name'             => 'رزكارى',
                'lijna_code'           => 'رزكارى',
                'leq_id' => 1,
            ],
            [
                'name'             => 'باتيَل',
                'lijna_code'           => 'باتيَل',
                'leq_id' => 1,
            ],
            [
                'name'             => 'زاكروس',
                'lijna_code'           => 'زاكروس',
                'leq_id' => 1,
            ],
            [
                'name'             => 'سةردةم',
                'lijna_code'           => 'سةردةم',
                'leq_id' => 1,
            ],
        ];

        Lijna::insert($lijnas);
    }
}
