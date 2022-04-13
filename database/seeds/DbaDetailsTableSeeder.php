<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DbaDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dba_details')->delete();
        
        \DB::table('dba_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'server_details_id' => 4,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IjRzYlB5NmdWWVwvNFwvT3lJNGVESnFuUT09IiwidmFsdWUiOiJhR1RacUNMM1NMWWtsalVqR0lUSWRRPT0iLCJtYWMiOiJiMjBjNTIwMWJjNjRjZGYzNzVlYjM4NGZhZWIzNDA5ZjNiYTY1YWI5NjMyZDBjZTcyYTE1NTRhYTg4MWYwZjc5In0=',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 07:47:07',
                'updated_at' => '2021-05-31 07:47:07',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'server_details_id' => 46,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IjNcL0UzcjdKSjhyNk8yZmpudnlsMFhBPT0iLCJ2YWx1ZSI6Ims0dkU5eWxRNEE2RzlJOWdLa1ZBU1E9PSIsIm1hYyI6ImJmZGI4MjgyYjI5ZGNmOTQwOGI2NjVlZjRkNzJhMTE0YjlmZDhkMzBmZmFlMzBjMTBmZTBiZWEwMTdjNzRiNGIifQ==',
                'db_sid' => 'devdb10d',
                'created_at' => '2021-05-31 07:47:28',
                'updated_at' => '2021-05-31 07:47:28',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'server_details_id' => 59,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IlwvcXF5ajd6bE5vRXkzUHV4b0w2Zll3PT0iLCJ2YWx1ZSI6InlJdWhxaitoR0pldjIxeXJrVXJ5Q2c9PSIsIm1hYyI6IjFmZDk4OTQ1NmMwOTA1MDEyNDA0MjU4MjkzMmIyMDJjMDE3YTc2MjFiNzFjZTBlMDk5ZGFjYjQyOTU3ZjhkZWQifQ==',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 07:47:51',
                'updated_at' => '2021-05-31 07:47:51',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'server_details_id' => 51,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IlFYT2tlWStrTmlpb1kxSVBDK3Vhb1E9PSIsInZhbHVlIjoieWF4SG5uOExGWHFwM05Qd3lsWkxBQT09IiwibWFjIjoiZGFmMTEwMjU0YzdjYjBiMWUyYzZjODJiODRmOTZhZTQ1MDkwNGE4OTdkNDgyOWZjNDAxZGM2NzVhZDA3NjAxZCJ9',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 07:48:30',
                'updated_at' => '2021-05-31 07:48:30',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'server_details_id' => 2,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6InZ3M0hETDB6SkdQUXJjODhNeWg0SlE9PSIsInZhbHVlIjoiclFXZzVodGlNSW1ESHZWXC9yQTMrRmc9PSIsIm1hYyI6ImFkYmVlNDViOTg5YTcxOWZiOWYwNWU2ZWEzN2M5OTBmYzcxNDM3Mzk5ZDA2ZjRkMDdiMzY2YmQ3MWVlNTZkMjAifQ==',
                'db_sid' => 'devdb8d',
                'created_at' => '2021-05-31 08:55:13',
                'updated_at' => '2021-05-31 08:55:13',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'server_details_id' => 111,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IjZNZm1EeHE4Y3hqOFI2VGlSRGhHWUE9PSIsInZhbHVlIjoiNGs3am9uTkc3NGdKeUtnSmNPbU45dz09IiwibWFjIjoiMTdhYmIyNDJkNWQ3ODU3NGVlZDIwYTY1MWI3NmQwYmM1YTRkOGU2ZTQ4MjgyNjUyMWQ0ODE3YjY4N2E2YTliNSJ9',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 08:55:43',
                'updated_at' => '2021-05-31 08:55:43',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'server_details_id' => 110,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IktrcUQrVkRaQkRvNXZwOTY4aTlNdlE9PSIsInZhbHVlIjoiQnhKXC9DSUNJajVRdFVlc1ppMm13ZEE9PSIsIm1hYyI6IjNiZjFlMTFhMmNjMTAyNDE3YThiYTBjMGRlZTc1NTRkNjUwMWFmYmMxMjY4OTc0Zjk1ZWUzYWYzY2RjNjgxY2MifQ==',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 08:56:14',
                'updated_at' => '2021-05-31 08:56:14',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'server_details_id' => 14,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6Ikk2UTNLOFg3aUh5M0p3SWI1alM0Mmc9PSIsInZhbHVlIjoiVFlEN052NTB5VTdyZ3huaGNMQTJJQT09IiwibWFjIjoiYjM2YWM0ZDRlYTA3MWYyZDdiMjZlOTE5NjRiNjlkZjQ4MTg1Y2RiMzY4ZmE5OGY5OGUyMTVlMjJkZjNlNDcxOSJ9',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 08:56:40',
                'updated_at' => '2021-05-31 08:56:40',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'server_details_id' => 17,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IllpMjhoWlp6TUlac2hTcHBtemVoTHc9PSIsInZhbHVlIjoiMlhJZFpHNmNQTGNFSHJJTDUrQjVlQT09IiwibWFjIjoiNjhmOTdhNTBjYzRmNzJlYmZjODJlODUxODcwNGY3NGJmNTdkMTIzY2Y5MDQ0MTQ5YTNhZThhZmM2ZjY0Y2I1ZSJ9',
                'db_sid' => 'orcl',
                'created_at' => '2021-05-31 09:02:07',
                'updated_at' => '2021-05-31 09:02:07',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'server_details_id' => 18,
                'dba_user' => 'adminuser',
                'dba_password' => 'eyJpdiI6IjdnSENDMG1EcmpYUlc3WENCOXBERWc9PSIsInZhbHVlIjoiVGpWM3FtNXVMMERYalpteVIyKzhoZz09IiwibWFjIjoiYWRmZmNlZDU0YTM3Yjg3MTZkNTQzM2RlYTMzMmVkZDdjOGFiYjY1NGFiOWNlY2ExMTg5NjUxMzkzYWQ1NGY2MiJ9',
                'db_sid' => 'spm01p',
                'created_at' => '2021-05-31 09:35:30',
                'updated_at' => '2021-05-31 09:35:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}