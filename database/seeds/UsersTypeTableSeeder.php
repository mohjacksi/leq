<?php

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $user_types = [
            [
                'id'             => 1,
                'name'           => 'ادمین',
                'code'          => 'admin',
            ],
            [
                'id'             => 2,
                'name'           => 'یوزەرێ لەقی',
                'code'          => 'leq',
            ],
            [
                'id'             => 3,
                'name'           => 'یوزەرێ لژنی',
                'code'          => 'lijna',
            ],
            [
                'id'             => 4,
                'name'           => 'یوزەرێ لژنی  🛑  ✋',
                'code'          => 'lijna_no_edit_delete',
            ],
            [
                'id'             => 5,
                'name'           => 'یوزەرێ بنگەهی',
                'code'          => 'bingeh',
            ],
            [
                'id'             => 6,
                'name'           => 'یوزەرێ بنگەهی  🛑 ✋',
                'code'          => 'bingeh_no_edit_delete',
            ],
            [
                'id'             => 7,
                'name'           => 'یوزەرێ دوماهیێ',
                'code'          => 'view',
            ],
        ];

        UserType::insert($user_types);
    }
}
