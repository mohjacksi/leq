<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        //admin
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));


        //leq
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });

        //leq
        $leq_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'daxlkrna_dengan_access',
                'daxlkrna_dengen_kandida_create',
                'daxlkrna_dengen_kandida_edit',
                'daxlkrna_dengen_kandida_show',
                'daxlkrna_dengen_kandida_delete',
                'daxlkrna_dengen_kandida_access',
                'daxlkrnarejabeshdarboyan_access',
                'reja_beshdarboyan_create',
                'reja_beshdarboyan_edit',
                'reja_beshdarboyan_show',
                'reja_beshdarboyan_delete',
                'reja_beshdarboyan_access',
            ]);
        });
        // substr($permission->title, 0, 5) != 'user_' 
        // && substr($permission->title, 0, 5) != 'role_' 
        // && substr($permission->title, 0, 11) != 'permission_';
        Role::findOrFail(2)->permissions()->sync($leq_permissions);

        //lijna
        $lijna_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'daxlkrna_dengan_access',
                'daxlkrna_dengen_kandida_create',
                'daxlkrna_dengen_kandida_edit',
                'daxlkrna_dengen_kandida_show',
                'daxlkrna_dengen_kandida_delete',
                'daxlkrna_dengen_kandida_access',
                'daxlkrnarejabeshdarboyan_access',
                'reja_beshdarboyan_create',
                'reja_beshdarboyan_edit',
                'reja_beshdarboyan_show',
                'reja_beshdarboyan_delete',
                'reja_beshdarboyan_access',
            ]);
        });
        Role::findOrFail(3)->permissions()->sync($lijna_permissions);

        //lijna_no_edit_delete
        $lijna_no_edit_delete_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'daxlkrna_dengan_access',
                'daxlkrna_dengen_kandida_create',
                'daxlkrna_dengen_kandida_show',
                'daxlkrna_dengen_kandida_access',
                'daxlkrnarejabeshdarboyan_access',
                'reja_beshdarboyan_create',
                'reja_beshdarboyan_show',
                'reja_beshdarboyan_access',
            ]);
        });
        Role::findOrFail(4)->permissions()->sync($lijna_no_edit_delete_permissions);

        //bingeh
        $bingeh_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'daxlkrna_dengan_access',
                'daxlkrna_dengen_kandida_create',
                'daxlkrna_dengen_kandida_edit',
                'daxlkrna_dengen_kandida_show',
                'daxlkrna_dengen_kandida_delete',
                'daxlkrna_dengen_kandida_access',
                'daxlkrnarejabeshdarboyan_access',
                'reja_beshdarboyan_create',
                'reja_beshdarboyan_edit',
                'reja_beshdarboyan_show',
                'reja_beshdarboyan_delete',
                'reja_beshdarboyan_access',
            ]);
        });
        Role::findOrFail(5)->permissions()->sync($bingeh_permissions);

        //bingeh_no_edit_delete
        $bingeh_no_edit_delete_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'daxlkrna_dengan_access',
                'daxlkrna_dengen_kandida_create',
                'daxlkrna_dengen_kandida_show',
                'daxlkrna_dengen_kandida_access',
                'daxlkrnarejabeshdarboyan_access',
                'reja_beshdarboyan_create',
                'reja_beshdarboyan_show',
                'reja_beshdarboyan_access',
            ]);
        });
        Role::findOrFail(6)->permissions()->sync($bingeh_no_edit_delete_permissions);

        //view
        $view_permissions = $admin_permissions->filter(function ($permission) {
            return in_array($permission->title, [
                'derencamen_rejabeshdarboyan_access',
                'web_site_view_access',
            ]);
        });
        Role::findOrFail(7)->permissions()->sync($view_permissions);
    }
}
