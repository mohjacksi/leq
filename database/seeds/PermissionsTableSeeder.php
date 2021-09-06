<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'dagrtnapezanina_access',
            ],
            [
                'id'    => 18,
                'title' => 'leq_create',
            ],
            [
                'id'    => 19,
                'title' => 'leq_edit',
            ],
            [
                'id'    => 20,
                'title' => 'leq_show',
            ],
            [
                'id'    => 21,
                'title' => 'leq_delete',
            ],
            [
                'id'    => 22,
                'title' => 'leq_access',
            ],
            [
                'id'    => 23,
                'title' => 'lijna_create',
            ],
            [
                'id'    => 24,
                'title' => 'lijna_edit',
            ],
            [
                'id'    => 25,
                'title' => 'lijna_show',
            ],
            [
                'id'    => 26,
                'title' => 'lijna_delete',
            ],
            [
                'id'    => 27,
                'title' => 'lijna_access',
            ],
            [
                'id'    => 28,
                'title' => 'rekxraw_create',
            ],
            [
                'id'    => 29,
                'title' => 'rekxraw_edit',
            ],
            [
                'id'    => 30,
                'title' => 'rekxraw_show',
            ],
            [
                'id'    => 31,
                'title' => 'rekxraw_delete',
            ],
            [
                'id'    => 32,
                'title' => 'rekxraw_access',
            ],
            [
                'id'    => 33,
                'title' => 'bingeh_create',
            ],
            [
                'id'    => 34,
                'title' => 'bingeh_edit',
            ],
            [
                'id'    => 35,
                'title' => 'bingeh_show',
            ],
            [
                'id'    => 36,
                'title' => 'bingeh_delete',
            ],
            [
                'id'    => 37,
                'title' => 'bingeh_access',
            ],
            [
                'id'    => 38,
                'title' => 'westgeh_create',
            ],
            [
                'id'    => 39,
                'title' => 'westgeh_edit',
            ],
            [
                'id'    => 40,
                'title' => 'westgeh_show',
            ],
            [
                'id'    => 41,
                'title' => 'westgeh_delete',
            ],
            [
                'id'    => 42,
                'title' => 'westgeh_access',
            ],
            [
                'id'    => 43,
                'title' => 'layenetsiyasi_create',
            ],
            [
                'id'    => 44,
                'title' => 'layenetsiyasi_edit',
            ],
            [
                'id'    => 45,
                'title' => 'layenetsiyasi_show',
            ],
            [
                'id'    => 46,
                'title' => 'layenetsiyasi_delete',
            ],
            [
                'id'    => 47,
                'title' => 'layenetsiyasi_access',
            ],
            [
                'id'    => 48,
                'title' => 'kandid_create',
            ],
            [
                'id'    => 49,
                'title' => 'kandid_edit',
            ],
            [
                'id'    => 50,
                'title' => 'kandid_show',
            ],
            [
                'id'    => 51,
                'title' => 'kandid_delete',
            ],
            [
                'id'    => 52,
                'title' => 'kandid_access',
            ],
            [
                'id'    => 53,
                'title' => 'daxlkrna_dengan_access',
            ],
            [
                'id'    => 54,
                'title' => 'dengen_layenetsiyasi_create',
            ],
            [
                'id'    => 55,
                'title' => 'dengen_layenetsiyasi_edit',
            ],
            [
                'id'    => 56,
                'title' => 'dengen_layenetsiyasi_show',
            ],
            [
                'id'    => 57,
                'title' => 'dengen_layenetsiyasi_delete',
            ],
            [
                'id'    => 58,
                'title' => 'dengen_layenetsiyasi_access',
            ],
            [
                'id'    => 59,
                'title' => 'daxlkrna_dengen_kandida_create',
            ],
            [
                'id'    => 60,
                'title' => 'daxlkrna_dengen_kandida_edit',
            ],
            [
                'id'    => 61,
                'title' => 'daxlkrna_dengen_kandida_show',
            ],
            [
                'id'    => 62,
                'title' => 'daxlkrna_dengen_kandida_delete',
            ],
            [
                'id'    => 63,
                'title' => 'daxlkrna_dengen_kandida_access',
            ],
            [
                'id'    => 64,
                'title' => 'daxlkrnarejabeshdarboyan_access',
            ],
            [
                'id'    => 65,
                'title' => 'reja_beshdarboyan_create',
            ],
            [
                'id'    => 66,
                'title' => 'reja_beshdarboyan_edit',
            ],
            [
                'id'    => 67,
                'title' => 'reja_beshdarboyan_show',
            ],
            [
                'id'    => 68,
                'title' => 'reja_beshdarboyan_delete',
            ],
            [
                'id'    => 69,
                'title' => 'reja_beshdarboyan_access',
            ],
            [
                'id'    => 70,
                'title' => 'hnartn_access',
            ],
            [
                'id'    => 71,
                'title' => 'hnartna_dengan_create',
            ],
            [
                'id'    => 72,
                'title' => 'hnartna_dengan_edit',
            ],
            [
                'id'    => 73,
                'title' => 'hnartna_dengan_show',
            ],
            [
                'id'    => 74,
                'title' => 'hnartna_dengan_delete',
            ],
            [
                'id'    => 75,
                'title' => 'hnartna_dengan_access',
            ],
            [
                'id'    => 76,
                'title' => 'hnartna_reja_beshdarboyan_create',
            ],
            [
                'id'    => 77,
                'title' => 'hnartna_reja_beshdarboyan_edit',
            ],
            [
                'id'    => 78,
                'title' => 'hnartna_reja_beshdarboyan_show',
            ],
            [
                'id'    => 79,
                'title' => 'hnartna_reja_beshdarboyan_delete',
            ],
            [
                'id'    => 80,
                'title' => 'hnartna_reja_beshdarboyan_access',
            ],
            [
                'id'    => 81,
                'title' => 'encamen_destpeke_create',
            ],
            [
                'id'    => 82,
                'title' => 'encamen_destpeke_edit',
            ],
            [
                'id'    => 83,
                'title' => 'encamen_destpeke_show',
            ],
            [
                'id'    => 84,
                'title' => 'encamen_destpeke_delete',
            ],
            [
                'id'    => 85,
                'title' => 'encamen_destpeke_access',
            ],
            [
                'id'    => 86,
                'title' => 'derencamen_destpeke_create',
            ],
            [
                'id'    => 87,
                'title' => 'derencamen_destpeke_edit',
            ],
            [
                'id'    => 88,
                'title' => 'derencamen_destpeke_show',
            ],
            [
                'id'    => 89,
                'title' => 'derencamen_destpeke_delete',
            ],
            [
                'id'    => 90,
                'title' => 'derencamen_destpeke_access',
            ],
            [
                'id'    => 91,
                'title' => 'derencamen_destpeke_bngeh_create',
            ],
            [
                'id'    => 92,
                'title' => 'derencamen_destpeke_bngeh_edit',
            ],
            [
                'id'    => 93,
                'title' => 'derencamen_destpeke_bngeh_show',
            ],
            [
                'id'    => 94,
                'title' => 'derencamen_destpeke_bngeh_delete',
            ],
            [
                'id'    => 95,
                'title' => 'derencamen_destpeke_bngeh_access',
            ],
            [
                'id'    => 96,
                'title' => 'derencamen_destpekewistgeh_create',
            ],
            [
                'id'    => 97,
                'title' => 'derencamen_destpekewistgeh_edit',
            ],
            [
                'id'    => 98,
                'title' => 'derencamen_destpekewistgeh_show',
            ],
            [
                'id'    => 99,
                'title' => 'derencamen_destpekewistgeh_delete',
            ],
            [
                'id'    => 100,
                'title' => 'derencamen_destpekewistgeh_access',
            ],
            [
                'id'    => 101,
                'title' => 'derencamen_rejabeshdarboyan_create',
            ],
            [
                'id'    => 102,
                'title' => 'derencamen_rejabeshdarboyan_edit',
            ],
            [
                'id'    => 103,
                'title' => 'derencamen_rejabeshdarboyan_show',
            ],
            [
                'id'    => 104,
                'title' => 'derencamen_rejabeshdarboyan_delete',
            ],
            [
                'id'    => 105,
                'title' => 'derencamen_rejabeshdarboyan_access',
            ],
            [
                'id'    => 106,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 107,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 108,
                'title' => 'user_type_create',
            ],
            [
                'id'    => 109,
                'title' => 'user_type_edit',
            ],
            [
                'id'    => 110,
                'title' => 'user_type_show',
            ],
            [
                'id'    => 111,
                'title' => 'user_type_delete',
            ],
            [
                'id'    => 112,
                'title' => 'user_type_access',
            ],
            [
                'id'    => 113,
                'title' => 'time_create',
            ],
            [
                'id'    => 114,
                'title' => 'time_edit',
            ],
            [
                'id'    => 115,
                'title' => 'time_show',
            ],
            [
                'id'    => 116,
                'title' => 'time_delete',
            ],
            [
                'id'    => 117,
                'title' => 'time_access',
            ],
            [
                'id'    => 118,
                'title' => 'web_site_view_create',
            ],
            [
                'id'    => 119,
                'title' => 'web_site_view_edit',
            ],
            [
                'id'    => 120,
                'title' => 'web_site_view_show',
            ],
            [
                'id'    => 121,
                'title' => 'web_site_view_delete',
            ],
            [
                'id'    => 122,
                'title' => 'web_site_view_access',
            ],
            [
                'id'    => 123,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
