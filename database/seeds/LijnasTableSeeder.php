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
            ],
            [
                'name'             => 'خابور',
                'lijna_code'           => 'خابور',
            ],
            [
                'name'             => 'سةرهلدان',
                'lijna_code'           => 'سةرهلدان',
            ],
            [
                'name'             => 'كولان',
                'lijna_code'           => 'كولان',
            ],
            [
                'name'             => 'هيزل',
                'lijna_code'           => 'هيزل',
            ],
            [
                'name'             => 'دةركار',
                'lijna_code'           => 'دةركار',
            ],
            [
                'name'             => 'باتيفا',
                'lijna_code'           => 'باتيفا',
            ],
            [
                'name'             => 'رزكارى',
                'lijna_code'           => 'رزكارى',
            ],
            [
                'name'             => 'باتيَل',
                'lijna_code'           => 'باتيَل',
            ],
            [
                'name'             => 'زاكروس',
                'lijna_code'           => 'زاكروس',
            ],
            [
                'name'             => 'سةردةم',
                'lijna_code'           => 'سةردةم',
            ],
        ];

        Lijna::insert($lijnas);
    }
}
