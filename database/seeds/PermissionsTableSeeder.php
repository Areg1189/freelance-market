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
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_hooks',
                'table_name' => NULL,
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'browse_polls',
                'table_name' => 'polls',
                'created_at' => '2019-01-16 03:45:42',
                'updated_at' => '2019-01-16 03:45:42',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'read_polls',
                'table_name' => 'polls',
                'created_at' => '2019-01-16 03:45:42',
                'updated_at' => '2019-01-16 03:45:42',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'edit_polls',
                'table_name' => 'polls',
                'created_at' => '2019-01-16 03:45:42',
                'updated_at' => '2019-01-16 03:45:42',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'add_polls',
                'table_name' => 'polls',
                'created_at' => '2019-01-16 03:45:42',
                'updated_at' => '2019-01-16 03:45:42',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'delete_polls',
                'table_name' => 'polls',
                'created_at' => '2019-01-16 03:45:42',
                'updated_at' => '2019-01-16 03:45:42',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'browse_skills',
                'table_name' => 'skills',
                'created_at' => '2019-01-16 04:21:03',
                'updated_at' => '2019-01-16 04:21:03',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'read_skills',
                'table_name' => 'skills',
                'created_at' => '2019-01-16 04:21:03',
                'updated_at' => '2019-01-16 04:21:03',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'edit_skills',
                'table_name' => 'skills',
                'created_at' => '2019-01-16 04:21:03',
                'updated_at' => '2019-01-16 04:21:03',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'add_skills',
                'table_name' => 'skills',
                'created_at' => '2019-01-16 04:21:03',
                'updated_at' => '2019-01-16 04:21:03',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'delete_skills',
                'table_name' => 'skills',
                'created_at' => '2019-01-16 04:21:03',
                'updated_at' => '2019-01-16 04:21:03',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'browse_freelance_titles',
                'table_name' => 'freelance_titles',
                'created_at' => '2019-01-16 04:31:18',
                'updated_at' => '2019-01-16 04:31:18',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'read_freelance_titles',
                'table_name' => 'freelance_titles',
                'created_at' => '2019-01-16 04:31:18',
                'updated_at' => '2019-01-16 04:31:18',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'edit_freelance_titles',
                'table_name' => 'freelance_titles',
                'created_at' => '2019-01-16 04:31:18',
                'updated_at' => '2019-01-16 04:31:18',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'add_freelance_titles',
                'table_name' => 'freelance_titles',
                'created_at' => '2019-01-16 04:31:18',
                'updated_at' => '2019-01-16 04:31:18',
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'delete_freelance_titles',
                'table_name' => 'freelance_titles',
                'created_at' => '2019-01-16 04:31:18',
                'updated_at' => '2019-01-16 04:31:18',
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'browse_portfolios',
                'table_name' => 'portfolios',
                'created_at' => '2019-01-16 06:52:06',
                'updated_at' => '2019-01-16 06:52:06',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'read_portfolios',
                'table_name' => 'portfolios',
                'created_at' => '2019-01-16 06:52:06',
                'updated_at' => '2019-01-16 06:52:06',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'edit_portfolios',
                'table_name' => 'portfolios',
                'created_at' => '2019-01-16 06:52:06',
                'updated_at' => '2019-01-16 06:52:06',
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'add_portfolios',
                'table_name' => 'portfolios',
                'created_at' => '2019-01-16 06:52:06',
                'updated_at' => '2019-01-16 06:52:06',
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'delete_portfolios',
                'table_name' => 'portfolios',
                'created_at' => '2019-01-16 06:52:06',
                'updated_at' => '2019-01-16 06:52:06',
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'browse_freelancers',
                'table_name' => 'freelancers',
                'created_at' => '2019-01-16 10:33:20',
                'updated_at' => '2019-01-16 10:33:20',
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'read_freelancers',
                'table_name' => 'freelancers',
                'created_at' => '2019-01-16 10:33:20',
                'updated_at' => '2019-01-16 10:33:20',
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'edit_freelancers',
                'table_name' => 'freelancers',
                'created_at' => '2019-01-16 10:33:20',
                'updated_at' => '2019-01-16 10:33:20',
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'add_freelancers',
                'table_name' => 'freelancers',
                'created_at' => '2019-01-16 10:33:20',
                'updated_at' => '2019-01-16 10:33:20',
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'delete_freelancers',
                'table_name' => 'freelancers',
                'created_at' => '2019-01-16 10:33:20',
                'updated_at' => '2019-01-16 10:33:20',
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'browse_jobs',
                'table_name' => 'jobs',
                'created_at' => '2019-01-18 07:06:38',
                'updated_at' => '2019-01-18 07:06:38',
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'read_jobs',
                'table_name' => 'jobs',
                'created_at' => '2019-01-18 07:06:38',
                'updated_at' => '2019-01-18 07:06:38',
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'edit_jobs',
                'table_name' => 'jobs',
                'created_at' => '2019-01-18 07:06:38',
                'updated_at' => '2019-01-18 07:06:38',
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'add_jobs',
                'table_name' => 'jobs',
                'created_at' => '2019-01-18 07:06:38',
                'updated_at' => '2019-01-18 07:06:38',
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'delete_jobs',
                'table_name' => 'jobs',
                'created_at' => '2019-01-18 07:06:38',
                'updated_at' => '2019-01-18 07:06:38',
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'browse_plans',
                'table_name' => 'plans',
                'created_at' => '2019-01-18 07:12:26',
                'updated_at' => '2019-01-18 07:12:26',
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'read_plans',
                'table_name' => 'plans',
                'created_at' => '2019-01-18 07:12:26',
                'updated_at' => '2019-01-18 07:12:26',
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'edit_plans',
                'table_name' => 'plans',
                'created_at' => '2019-01-18 07:12:26',
                'updated_at' => '2019-01-18 07:12:26',
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'add_plans',
                'table_name' => 'plans',
                'created_at' => '2019-01-18 07:12:26',
                'updated_at' => '2019-01-18 07:12:26',
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'delete_plans',
                'table_name' => 'plans',
                'created_at' => '2019-01-18 07:12:26',
                'updated_at' => '2019-01-18 07:12:26',
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'browse_employers',
                'table_name' => 'employers',
                'created_at' => '2019-01-20 21:20:07',
                'updated_at' => '2019-01-20 21:20:07',
            ),
            62 => 
            array (
                'id' => 63,
                'key' => 'read_employers',
                'table_name' => 'employers',
                'created_at' => '2019-01-20 21:20:07',
                'updated_at' => '2019-01-20 21:20:07',
            ),
            63 => 
            array (
                'id' => 64,
                'key' => 'edit_employers',
                'table_name' => 'employers',
                'created_at' => '2019-01-20 21:20:07',
                'updated_at' => '2019-01-20 21:20:07',
            ),
            64 => 
            array (
                'id' => 65,
                'key' => 'add_employers',
                'table_name' => 'employers',
                'created_at' => '2019-01-20 21:20:07',
                'updated_at' => '2019-01-20 21:20:07',
            ),
            65 => 
            array (
                'id' => 66,
                'key' => 'delete_employers',
                'table_name' => 'employers',
                'created_at' => '2019-01-20 21:20:07',
                'updated_at' => '2019-01-20 21:20:07',
            ),
            66 => 
            array (
                'id' => 67,
                'key' => 'browse_messages',
                'table_name' => 'messages',
                'created_at' => '2019-01-24 14:47:44',
                'updated_at' => '2019-01-24 14:47:44',
            ),
            67 => 
            array (
                'id' => 68,
                'key' => 'read_messages',
                'table_name' => 'messages',
                'created_at' => '2019-01-24 14:47:44',
                'updated_at' => '2019-01-24 14:47:44',
            ),
            68 => 
            array (
                'id' => 69,
                'key' => 'edit_messages',
                'table_name' => 'messages',
                'created_at' => '2019-01-24 14:47:44',
                'updated_at' => '2019-01-24 14:47:44',
            ),
            69 => 
            array (
                'id' => 70,
                'key' => 'add_messages',
                'table_name' => 'messages',
                'created_at' => '2019-01-24 14:47:44',
                'updated_at' => '2019-01-24 14:47:44',
            ),
            70 => 
            array (
                'id' => 71,
                'key' => 'delete_messages',
                'table_name' => 'messages',
                'created_at' => '2019-01-24 14:47:44',
                'updated_at' => '2019-01-24 14:47:44',
            ),
            71 => 
            array (
                'id' => 72,
                'key' => 'browse_freelancer_job',
                'table_name' => 'freelancer_job',
                'created_at' => '2019-02-07 11:16:05',
                'updated_at' => '2019-02-07 11:16:05',
            ),
            72 => 
            array (
                'id' => 73,
                'key' => 'read_freelancer_job',
                'table_name' => 'freelancer_job',
                'created_at' => '2019-02-07 11:16:05',
                'updated_at' => '2019-02-07 11:16:05',
            ),
            73 => 
            array (
                'id' => 74,
                'key' => 'edit_freelancer_job',
                'table_name' => 'freelancer_job',
                'created_at' => '2019-02-07 11:16:05',
                'updated_at' => '2019-02-07 11:16:05',
            ),
            74 => 
            array (
                'id' => 75,
                'key' => 'add_freelancer_job',
                'table_name' => 'freelancer_job',
                'created_at' => '2019-02-07 11:16:05',
                'updated_at' => '2019-02-07 11:16:05',
            ),
            75 => 
            array (
                'id' => 76,
                'key' => 'delete_freelancer_job',
                'table_name' => 'freelancer_job',
                'created_at' => '2019-02-07 11:16:05',
                'updated_at' => '2019-02-07 11:16:05',
            ),
            76 => 
            array (
                'id' => 82,
                'key' => 'browse_permissions',
                'table_name' => 'permissions',
                'created_at' => '2019-02-07 12:08:31',
                'updated_at' => '2019-02-07 12:08:31',
            ),
            77 => 
            array (
                'id' => 83,
                'key' => 'read_permissions',
                'table_name' => 'permissions',
                'created_at' => '2019-02-07 12:08:31',
                'updated_at' => '2019-02-07 12:08:31',
            ),
            78 => 
            array (
                'id' => 84,
                'key' => 'edit_permissions',
                'table_name' => 'permissions',
                'created_at' => '2019-02-07 12:08:31',
                'updated_at' => '2019-02-07 12:08:31',
            ),
            79 => 
            array (
                'id' => 85,
                'key' => 'add_permissions',
                'table_name' => 'permissions',
                'created_at' => '2019-02-07 12:08:31',
                'updated_at' => '2019-02-07 12:08:31',
            ),
            80 => 
            array (
                'id' => 86,
                'key' => 'delete_permissions',
                'table_name' => 'permissions',
                'created_at' => '2019-02-07 12:08:31',
                'updated_at' => '2019-02-07 12:08:31',
            ),
        ));
        
        
    }
}