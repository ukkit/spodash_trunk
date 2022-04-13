<?php

use Illuminate\Database\Seeder;

class SprintCalendarsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sprint_calendars')->delete();
        
        \DB::table('sprint_calendars')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sprint_number' => 2001,
                'sprint_start_date' => '2020-01-15',
                'sprint_end_date' => '2020-02-12',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'sprint_number' => 2002,
                'sprint_start_date' => '2020-02-12',
                'sprint_end_date' => '2020-03-11',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'sprint_number' => 2003,
                'sprint_start_date' => '2020-03-11',
                'sprint_end_date' => '2020-04-08',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'sprint_number' => 2004,
                'sprint_start_date' => '2020-04-08',
                'sprint_end_date' => '2020-05-06',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'sprint_number' => 2005,
                'sprint_start_date' => '2020-05-06',
                'sprint_end_date' => '2020-06-03',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 14,
                'sprint_number' => 1801,
                'sprint_start_date' => '2018-01-17',
                'sprint_end_date' => '2018-02-14',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 15,
                'sprint_number' => 1802,
                'sprint_start_date' => '2018-02-14',
                'sprint_end_date' => '2018-03-14',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 16,
                'sprint_number' => 1803,
                'sprint_start_date' => '2018-03-14',
                'sprint_end_date' => '2018-04-11',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 17,
                'sprint_number' => 1804,
                'sprint_start_date' => '2018-04-11',
                'sprint_end_date' => '2018-05-09',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 18,
                'sprint_number' => 1805,
                'sprint_start_date' => '2018-05-09',
                'sprint_end_date' => '2018-06-06',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-04-29 10:51:23',
                'updated_at' => '2020-04-29 10:51:23',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 19,
                'sprint_number' => 1806,
                'sprint_start_date' => '2018-06-06',
                'sprint_end_date' => '2018-07-04',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 20,
                'sprint_number' => 1807,
                'sprint_start_date' => '2018-07-04',
                'sprint_end_date' => '2018-08-01',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 21,
                'sprint_number' => 1808,
                'sprint_start_date' => '2018-08-01',
                'sprint_end_date' => '2018-08-29',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 22,
                'sprint_number' => 1809,
                'sprint_start_date' => '2018-08-29',
                'sprint_end_date' => '2018-09-26',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 23,
                'sprint_number' => 1810,
                'sprint_start_date' => '2018-09-26',
                'sprint_end_date' => '2018-10-24',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 24,
                'sprint_number' => 1811,
                'sprint_start_date' => '2018-10-24',
                'sprint_end_date' => '2018-11-21',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 25,
                'sprint_number' => 1812,
                'sprint_start_date' => '2018-11-21',
                'sprint_end_date' => '2018-12-19',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 26,
                'sprint_number' => 1813,
                'sprint_start_date' => '2018-12-19',
                'sprint_end_date' => '2019-01-16',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 27,
                'sprint_number' => 1901,
                'sprint_start_date' => '2019-01-16',
                'sprint_end_date' => '2019-02-13',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 28,
                'sprint_number' => 1902,
                'sprint_start_date' => '2019-02-13',
                'sprint_end_date' => '2019-03-13',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 29,
                'sprint_number' => 1903,
                'sprint_start_date' => '2019-03-13',
                'sprint_end_date' => '2019-04-10',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 30,
                'sprint_number' => 1904,
                'sprint_start_date' => '2019-04-10',
                'sprint_end_date' => '2019-05-08',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 31,
                'sprint_number' => 1905,
                'sprint_start_date' => '2019-05-08',
                'sprint_end_date' => '2019-06-05',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 32,
                'sprint_number' => 1906,
                'sprint_start_date' => '2019-06-05',
                'sprint_end_date' => '2019-07-03',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 33,
                'sprint_number' => 1907,
                'sprint_start_date' => '2019-07-03',
                'sprint_end_date' => '2019-07-31',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 34,
                'sprint_number' => 1908,
                'sprint_start_date' => '2019-07-31',
                'sprint_end_date' => '2019-08-28',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 35,
                'sprint_number' => 1909,
                'sprint_start_date' => '2019-08-28',
                'sprint_end_date' => '2019-09-25',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 36,
                'sprint_number' => 1910,
                'sprint_start_date' => '2019-09-25',
                'sprint_end_date' => '2019-10-23',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 37,
                'sprint_number' => 1911,
                'sprint_start_date' => '2019-10-23',
                'sprint_end_date' => '2019-11-20',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 38,
                'sprint_number' => 1912,
                'sprint_start_date' => '2019-11-20',
                'sprint_end_date' => '2019-12-18',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 39,
                'sprint_number' => 1913,
                'sprint_start_date' => '2019-12-18',
                'sprint_end_date' => '2020-01-15',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 40,
                'sprint_number' => 2006,
                'sprint_start_date' => '2020-06-03',
                'sprint_end_date' => '2020-06-24',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:55:41',
                'updated_at' => '2020-06-25 14:55:41',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 41,
                'sprint_number' => 2007,
                'sprint_start_date' => '2020-06-24',
                'sprint_end_date' => '2020-07-15',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:56:11',
                'updated_at' => '2020-06-25 14:56:11',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 42,
                'sprint_number' => 2008,
                'sprint_start_date' => '2020-07-15',
                'sprint_end_date' => '2020-08-05',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:56:39',
                'updated_at' => '2020-06-25 14:56:39',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 43,
                'sprint_number' => 2009,
                'sprint_start_date' => '2020-08-05',
                'sprint_end_date' => '2020-08-26',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:57:06',
                'updated_at' => '2020-06-25 14:57:06',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 44,
                'sprint_number' => 2010,
                'sprint_start_date' => '2020-08-26',
                'sprint_end_date' => '2020-09-16',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:57:29',
                'updated_at' => '2020-06-25 14:57:29',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 45,
                'sprint_number' => 2011,
                'sprint_start_date' => '2020-09-16',
                'sprint_end_date' => '2020-10-07',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:57:55',
                'updated_at' => '2020-06-25 14:57:55',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 46,
                'sprint_number' => 2012,
                'sprint_start_date' => '2020-10-07',
                'sprint_end_date' => '2020-10-28',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:58:15',
                'updated_at' => '2020-06-25 14:58:15',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 47,
                'sprint_number' => 2013,
                'sprint_start_date' => '2020-10-28',
                'sprint_end_date' => '2020-11-18',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:58:34',
                'updated_at' => '2020-06-25 14:58:34',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 48,
                'sprint_number' => 2014,
                'sprint_start_date' => '2020-11-18',
                'sprint_end_date' => '2020-12-09',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:58:52',
                'updated_at' => '2020-06-25 14:58:52',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 49,
                'sprint_number' => 2015,
                'sprint_start_date' => '2020-12-09',
                'sprint_end_date' => '2020-12-30',
                'sprint_end_date_same_as_next_start_date' => 'Y',
                'created_at' => '2020-06-25 14:59:13',
                'updated_at' => '2020-06-25 14:59:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}