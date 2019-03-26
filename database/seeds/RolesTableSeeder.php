<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'display_name' => 'Normal User',
                'created_at' => '2019-01-16 03:26:51',
                'updated_at' => '2019-01-16 03:26:51',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'freelancer',
                'display_name' => 'Freelancer',
                'created_at' => '2019-01-17 04:35:47',
                'updated_at' => '2019-01-17 04:35:47',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'employer',
                'display_name' => 'Employer',
                'created_at' => '2019-01-17 04:36:02',
                'updated_at' => '2019-01-20 21:46:37',
            ),
        ));
        
        
    }
}