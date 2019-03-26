<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$.5kmRvsc1ErwPh2kwMhnCeFWRk3htfLSLdYstS3b7NjZv6hYc2S0O',
                'remember_token' => '1uVU2mddYLJ4bXKysVI1kLLDWTDwg3d3MUzul9TXpXPpWuYDzeOc3gdq0B4N',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-01-16 03:33:51',
                'updated_at' => '2019-01-16 05:45:36',
                'slug' => 'admin',
            ),
            1 => 
            array (
                'id' => 2,
                'role_id' => 3,
                'name' => 'Yevgen Sa.',
                'email' => 'example@example.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6skrmS2IXo0cQbntrAPjw.AFV07lnLn0Ys7DPrIFAcWFjUDcJh3Ju',
                'remember_token' => '6ou35HsRoGYun9sfv7ipG2lKmYZit3R9JcG6y7QftcDL17WIdiJbvODMGiRq',
                'settings' => NULL,
                'created_at' => '2019-01-20 13:29:43',
                'updated_at' => '2019-01-20 13:34:38',
                'slug' => 'yevgen-s',
            ),
            2 => 
            array (
                'id' => 5,
                'role_id' => 3,
                'name' => 'John Kenneth As.',
                'email' => 'example1@example.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6OPhnwBv8zsHtG/hN6wc4.7HqslmlNrVyXhzN07QyOEzxEljQv97S',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2019-01-20 13:44:17',
                'updated_at' => '2019-01-20 13:46:34',
                'slug' => 'john-kenneth-a',
            ),
            3 => 
            array (
                'id' => 6,
                'role_id' => 4,
                'name' => 'Employer Employer',
                'email' => 'employer@employer.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => '2019-01-20 21:45:09',
                'password' => '$2y$10$AEryfPo1clARQUMNhecOCOUUttY6c8w5l/lmDAq1ity.UBnousfB.',
                'remember_token' => 'mdHcsRodV36AsBBErKuCvMtcwxypyHPGvhtPhMEUyYpQiQ0IViaCNjMDxYuR',
                'settings' => '{"locale":"en"}',
                'created_at' => '2019-01-20 21:45:10',
                'updated_at' => '2019-01-20 21:46:52',
                'slug' => 'employer-employer',
            ),
            4 => 
            array (
                'id' => 14,
                'role_id' => 4,
                'name' => 'Test last',
                'email' => '3test@test.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$kEMrdSuIvtHza5/zuJPDdOel0cN78gbauTSLK0NJ3lWpCRNFeHuly',
                'remember_token' => 'qZ5PBaSAIcgZ1KOHQIvNGlvIwN5XVPDFGYqfHjdjOKW36ySxfrNGAFDWCLCK',
                'settings' => NULL,
                'created_at' => '2019-01-21 09:02:21',
                'updated_at' => '2019-01-21 09:02:21',
                'slug' => 'test-last',
            ),
        ));
        
        
    }
}