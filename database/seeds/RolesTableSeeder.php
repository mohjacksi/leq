<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'admin',
            ],
            [
                'id'    => 2,
                'title' => 'leq',
            ],
            [
                'id'    => 3,
                'title' => 'lijna',
            ],
            [
                'id'    => 4,
                'title' => 'lijna_no_edit_delete',
            ],
            [
                'id'    => 5,
                'title' => 'bingeh',
            ],            
            [
                'id'    => 6,
                'title' => 'bingeh_no_edit_delete',
            ],
            [
                'id'    => 7,
                'title' => 'view',
            ],
        ];

        Role::insert($roles);
    }
}
