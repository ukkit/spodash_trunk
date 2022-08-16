<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('role_has_permissions')->delete();

        \DB::table('role_has_permissions')->insert([
            0 => [
                'permission_id' => 112,
                'role_id' => 10,
            ],
            1 => [
                'permission_id' => 114,
                'role_id' => 10,
            ],
            2 => [
                'permission_id' => 116,
                'role_id' => 10,
            ],
            3 => [
                'permission_id' => 120,
                'role_id' => 9,
            ],
            4 => [
                'permission_id' => 120,
                'role_id' => 10,
            ],
            5 => [
                'permission_id' => 121,
                'role_id' => 9,
            ],
            6 => [
                'permission_id' => 121,
                'role_id' => 10,
            ],
            7 => [
                'permission_id' => 122,
                'role_id' => 8,
            ],
            8 => [
                'permission_id' => 122,
                'role_id' => 9,
            ],
            9 => [
                'permission_id' => 122,
                'role_id' => 10,
            ],
            10 => [
                'permission_id' => 122,
                'role_id' => 14,
            ],
            11 => [
                'permission_id' => 123,
                'role_id' => 8,
            ],
            12 => [
                'permission_id' => 123,
                'role_id' => 9,
            ],
            13 => [
                'permission_id' => 123,
                'role_id' => 10,
            ],
            14 => [
                'permission_id' => 123,
                'role_id' => 14,
            ],
            15 => [
                'permission_id' => 124,
                'role_id' => 8,
            ],
            16 => [
                'permission_id' => 124,
                'role_id' => 9,
            ],
            17 => [
                'permission_id' => 124,
                'role_id' => 10,
            ],
            18 => [
                'permission_id' => 124,
                'role_id' => 11,
            ],
            19 => [
                'permission_id' => 124,
                'role_id' => 14,
            ],
            20 => [
                'permission_id' => 125,
                'role_id' => 9,
            ],
            21 => [
                'permission_id' => 125,
                'role_id' => 10,
            ],
            22 => [
                'permission_id' => 126,
                'role_id' => 9,
            ],
            23 => [
                'permission_id' => 126,
                'role_id' => 10,
            ],
            24 => [
                'permission_id' => 128,
                'role_id' => 9,
            ],
            25 => [
                'permission_id' => 128,
                'role_id' => 10,
            ],
            26 => [
                'permission_id' => 129,
                'role_id' => 9,
            ],
            27 => [
                'permission_id' => 129,
                'role_id' => 10,
            ],
            28 => [
                'permission_id' => 130,
                'role_id' => 9,
            ],
            29 => [
                'permission_id' => 130,
                'role_id' => 10,
            ],
            30 => [
                'permission_id' => 131,
                'role_id' => 10,
            ],
            31 => [
                'permission_id' => 132,
                'role_id' => 8,
            ],
            32 => [
                'permission_id' => 132,
                'role_id' => 9,
            ],
            33 => [
                'permission_id' => 132,
                'role_id' => 10,
            ],
            34 => [
                'permission_id' => 132,
                'role_id' => 11,
            ],
            35 => [
                'permission_id' => 132,
                'role_id' => 14,
            ],
            36 => [
                'permission_id' => 133,
                'role_id' => 9,
            ],
            37 => [
                'permission_id' => 133,
                'role_id' => 10,
            ],
            38 => [
                'permission_id' => 134,
                'role_id' => 9,
            ],
            39 => [
                'permission_id' => 134,
                'role_id' => 10,
            ],
            40 => [
                'permission_id' => 135,
                'role_id' => 10,
            ],
            41 => [
                'permission_id' => 136,
                'role_id' => 9,
            ],
            42 => [
                'permission_id' => 136,
                'role_id' => 10,
            ],
            43 => [
                'permission_id' => 137,
                'role_id' => 9,
            ],
            44 => [
                'permission_id' => 137,
                'role_id' => 10,
            ],
            45 => [
                'permission_id' => 138,
                'role_id' => 9,
            ],
            46 => [
                'permission_id' => 138,
                'role_id' => 10,
            ],
            47 => [
                'permission_id' => 139,
                'role_id' => 10,
            ],
            48 => [
                'permission_id' => 140,
                'role_id' => 9,
            ],
            49 => [
                'permission_id' => 140,
                'role_id' => 10,
            ],
            50 => [
                'permission_id' => 141,
                'role_id' => 9,
            ],
            51 => [
                'permission_id' => 141,
                'role_id' => 10,
            ],
            52 => [
                'permission_id' => 142,
                'role_id' => 10,
            ],
            53 => [
                'permission_id' => 143,
                'role_id' => 10,
            ],
            54 => [
                'permission_id' => 144,
                'role_id' => 9,
            ],
            55 => [
                'permission_id' => 144,
                'role_id' => 10,
            ],
            56 => [
                'permission_id' => 145,
                'role_id' => 9,
            ],
            57 => [
                'permission_id' => 145,
                'role_id' => 10,
            ],
            58 => [
                'permission_id' => 146,
                'role_id' => 10,
            ],
            59 => [
                'permission_id' => 147,
                'role_id' => 10,
            ],
            60 => [
                'permission_id' => 148,
                'role_id' => 9,
            ],
            61 => [
                'permission_id' => 148,
                'role_id' => 10,
            ],
            62 => [
                'permission_id' => 149,
                'role_id' => 9,
            ],
            63 => [
                'permission_id' => 149,
                'role_id' => 10,
            ],
            64 => [
                'permission_id' => 150,
                'role_id' => 9,
            ],
            65 => [
                'permission_id' => 150,
                'role_id' => 10,
            ],
            66 => [
                'permission_id' => 151,
                'role_id' => 10,
            ],
            67 => [
                'permission_id' => 152,
                'role_id' => 9,
            ],
            68 => [
                'permission_id' => 152,
                'role_id' => 10,
            ],
            69 => [
                'permission_id' => 153,
                'role_id' => 9,
            ],
            70 => [
                'permission_id' => 153,
                'role_id' => 10,
            ],
            71 => [
                'permission_id' => 154,
                'role_id' => 9,
            ],
            72 => [
                'permission_id' => 154,
                'role_id' => 10,
            ],
            73 => [
                'permission_id' => 155,
                'role_id' => 10,
            ],
            74 => [
                'permission_id' => 156,
                'role_id' => 10,
            ],
            75 => [
                'permission_id' => 157,
                'role_id' => 10,
            ],
            76 => [
                'permission_id' => 158,
                'role_id' => 9,
            ],
            77 => [
                'permission_id' => 158,
                'role_id' => 10,
            ],
            78 => [
                'permission_id' => 159,
                'role_id' => 9,
            ],
            79 => [
                'permission_id' => 159,
                'role_id' => 10,
            ],
            80 => [
                'permission_id' => 161,
                'role_id' => 14,
            ],
            81 => [
                'permission_id' => 162,
                'role_id' => 14,
            ],
            82 => [
                'permission_id' => 163,
                'role_id' => 10,
            ],
            83 => [
                'permission_id' => 163,
                'role_id' => 14,
            ],
        ]);
    }
}
