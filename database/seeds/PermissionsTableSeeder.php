<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 111,
                'name' => 'show_permissions',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:19',
                'updated_at' => '2019-07-30 12:20:19',
            ),
            1 => 
            array (
                'id' => 112,
                'name' => 'view_users',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:21',
                'updated_at' => '2019-07-30 12:20:21',
            ),
            2 => 
            array (
                'id' => 113,
                'name' => 'add_users',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:23',
                'updated_at' => '2019-07-30 12:20:23',
            ),
            3 => 
            array (
                'id' => 114,
                'name' => 'edit_users',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:25',
                'updated_at' => '2019-07-30 12:20:25',
            ),
            4 => 
            array (
                'id' => 115,
                'name' => 'delete_users',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:28',
                'updated_at' => '2019-07-30 12:20:28',
            ),
            5 => 
            array (
                'id' => 116,
                'name' => 'view_roles',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:30',
                'updated_at' => '2019-07-30 12:20:30',
            ),
            6 => 
            array (
                'id' => 117,
                'name' => 'add_roles',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:33',
                'updated_at' => '2019-07-30 12:20:33',
            ),
            7 => 
            array (
                'id' => 118,
                'name' => 'edit_roles',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:35',
                'updated_at' => '2019-07-30 12:20:35',
            ),
            8 => 
            array (
                'id' => 119,
                'name' => 'delete_roles',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:37',
                'updated_at' => '2019-07-30 12:20:37',
            ),
            9 => 
            array (
                'id' => 120,
                'name' => 'start_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:39',
                'updated_at' => '2019-07-30 12:20:39',
            ),
            10 => 
            array (
                'id' => 121,
                'name' => 'stop_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:42',
                'updated_at' => '2019-07-30 12:20:42',
            ),
            11 => 
            array (
                'id' => 122,
                'name' => 'restart_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:44',
                'updated_at' => '2019-07-30 12:20:44',
            ),
            12 => 
            array (
                'id' => 123,
                'name' => 'upgrade_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:46',
                'updated_at' => '2019-07-30 12:20:46',
            ),
            13 => 
            array (
                'id' => 124,
                'name' => 'view_serverDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:48',
                'updated_at' => '2019-07-30 12:20:48',
            ),
            14 => 
            array (
                'id' => 125,
                'name' => 'add_serverDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:50',
                'updated_at' => '2019-07-30 12:20:50',
            ),
            15 => 
            array (
                'id' => 126,
                'name' => 'edit_serverDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:52',
                'updated_at' => '2019-07-30 12:20:52',
            ),
            16 => 
            array (
                'id' => 127,
                'name' => 'delete_serverDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:54',
                'updated_at' => '2019-07-30 12:20:54',
            ),
            17 => 
            array (
                'id' => 128,
                'name' => 'view_databaseDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:56',
                'updated_at' => '2019-07-30 12:20:56',
            ),
            18 => 
            array (
                'id' => 129,
                'name' => 'add_databaseDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:20:58',
                'updated_at' => '2019-07-30 12:20:58',
            ),
            19 => 
            array (
                'id' => 130,
                'name' => 'edit_databaseDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:00',
                'updated_at' => '2019-07-30 12:21:00',
            ),
            20 => 
            array (
                'id' => 131,
                'name' => 'delete_databaseDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:03',
                'updated_at' => '2019-07-30 12:21:03',
            ),
            21 => 
            array (
                'id' => 132,
                'name' => 'view_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:05',
                'updated_at' => '2019-07-30 12:21:05',
            ),
            22 => 
            array (
                'id' => 133,
                'name' => 'add_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:07',
                'updated_at' => '2019-07-30 12:21:07',
            ),
            23 => 
            array (
                'id' => 134,
                'name' => 'edit_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:09',
                'updated_at' => '2019-07-30 12:21:09',
            ),
            24 => 
            array (
                'id' => 135,
                'name' => 'delete_instanceDetails',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:11',
                'updated_at' => '2019-07-30 12:21:11',
            ),
            25 => 
            array (
                'id' => 136,
                'name' => 'view_databaseTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:13',
                'updated_at' => '2019-07-30 12:21:13',
            ),
            26 => 
            array (
                'id' => 137,
                'name' => 'add_databaseTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:15',
                'updated_at' => '2019-07-30 12:21:15',
            ),
            27 => 
            array (
                'id' => 138,
                'name' => 'edit_databaseTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:17',
                'updated_at' => '2019-07-30 12:21:17',
            ),
            28 => 
            array (
                'id' => 139,
                'name' => 'delete_databaseTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:19',
                'updated_at' => '2019-07-30 12:21:19',
            ),
            29 => 
            array (
                'id' => 140,
                'name' => 'view_osTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:21',
                'updated_at' => '2019-07-30 12:21:21',
            ),
            30 => 
            array (
                'id' => 141,
                'name' => 'add_osTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:23',
                'updated_at' => '2019-07-30 12:21:23',
            ),
            31 => 
            array (
                'id' => 142,
                'name' => 'edit_osTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:26',
                'updated_at' => '2019-07-30 12:21:26',
            ),
            32 => 
            array (
                'id' => 143,
                'name' => 'delete_osTypes',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:29',
                'updated_at' => '2019-07-30 12:21:29',
            ),
            33 => 
            array (
                'id' => 144,
                'name' => 'view_productNames',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:32',
                'updated_at' => '2019-07-30 12:21:32',
            ),
            34 => 
            array (
                'id' => 145,
                'name' => 'add_productNames',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:34',
                'updated_at' => '2019-07-30 12:21:34',
            ),
            35 => 
            array (
                'id' => 146,
                'name' => 'edit_productNames',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:36',
                'updated_at' => '2019-07-30 12:21:36',
            ),
            36 => 
            array (
                'id' => 147,
                'name' => 'delete_productNames',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:38',
                'updated_at' => '2019-07-30 12:21:38',
            ),
            37 => 
            array (
                'id' => 148,
                'name' => 'view_productVersions',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:40',
                'updated_at' => '2019-07-30 12:21:40',
            ),
            38 => 
            array (
                'id' => 149,
                'name' => 'add_productVersions',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:42',
                'updated_at' => '2019-07-30 12:21:42',
            ),
            39 => 
            array (
                'id' => 150,
                'name' => 'edit_productVersions',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:44',
                'updated_at' => '2019-07-30 12:21:44',
            ),
            40 => 
            array (
                'id' => 151,
                'name' => 'delete_productVersions',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:46',
                'updated_at' => '2019-07-30 12:21:46',
            ),
            41 => 
            array (
                'id' => 152,
                'name' => 'view_serverUses',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:48',
                'updated_at' => '2019-07-30 12:21:48',
            ),
            42 => 
            array (
                'id' => 153,
                'name' => 'add_serverUses',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:50',
                'updated_at' => '2019-07-30 12:21:50',
            ),
            43 => 
            array (
                'id' => 154,
                'name' => 'edit_serverUses',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:52',
                'updated_at' => '2019-07-30 12:21:52',
            ),
            44 => 
            array (
                'id' => 155,
                'name' => 'delete_serverUses',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:21:54',
                'updated_at' => '2019-07-30 12:21:54',
            ),
            45 => 
            array (
                'id' => 156,
                'name' => 'view_database_details',
                'guard_name' => 'web',
                'created_at' => '2019-07-30 12:59:00',
                'updated_at' => '2019-07-30 12:59:00',
            ),
            46 => 
            array (
                'id' => 157,
                'name' => 'add-actionHistories',
                'guard_name' => 'web',
                'created_at' => '2019-08-04 13:04:07',
                'updated_at' => '2019-08-04 13:04:07',
            ),
            47 => 
            array (
                'id' => 158,
                'name' => 'view-actionHistories',
                'guard_name' => 'web',
                'created_at' => '2019-08-04 13:04:15',
                'updated_at' => '2019-08-04 13:04:15',
            ),
            48 => 
            array (
                'id' => 159,
                'name' => 'edit-actionHistories',
                'guard_name' => 'web',
                'created_at' => '2019-08-04 13:04:19',
                'updated_at' => '2019-08-04 13:04:19',
            ),
            49 => 
            array (
                'id' => 160,
                'name' => 'delete-actionHistories',
                'guard_name' => 'web',
                'created_at' => '2019-08-04 13:04:23',
                'updated_at' => '2019-08-04 13:04:23',
            ),
            50 => 
            array (
                'id' => 161,
                'name' => 'add_releaseDetails',
                'guard_name' => 'web',
                'created_at' => '2020-04-25 19:25:45',
                'updated_at' => '2020-04-25 19:25:45',
            ),
            51 => 
            array (
                'id' => 162,
                'name' => 'edit_releaseDetails',
                'guard_name' => 'web',
                'created_at' => '2020-04-25 19:25:45',
                'updated_at' => '2020-04-25 19:25:45',
            ),
            52 => 
            array (
                'id' => 163,
                'name' => 'view_releaseDetails',
                'guard_name' => 'web',
                'created_at' => '2020-04-25 19:25:45',
                'updated_at' => '2020-04-25 19:25:45',
            ),
            53 => 
            array (
                'id' => 164,
                'name' => 'delete_releaseDetails',
                'guard_name' => 'web',
                'created_at' => '2020-04-25 19:25:45',
                'updated_at' => '2020-04-25 19:25:45',
            ),
        ));
        
        
    }
}