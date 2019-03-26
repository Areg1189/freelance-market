<?php

use Illuminate\Database\Seeder;

class FreelanceTitlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('freelance_titles')->delete();
        
        \DB::table('freelance_titles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Web Designer',
                'created_at' => '2019-01-16 04:40:02',
                'updated_at' => '2019-01-16 04:40:02',
                'slug' => 'web-designer',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Front End Developer',
                'created_at' => '2019-01-16 04:40:19',
                'updated_at' => '2019-01-16 04:40:19',
                'slug' => 'front-end-developer',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Coppywriter',
                'created_at' => '2019-01-16 04:40:31',
                'updated_at' => '2019-01-16 04:40:31',
                'slug' => 'coppywriter',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Design',
                'created_at' => '2019-01-16 04:40:40',
                'updated_at' => '2019-01-16 04:40:40',
                'slug' => 'design',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Backend Developer',
                'created_at' => '2019-01-16 04:40:54',
                'updated_at' => '2019-01-16 04:40:54',
                'slug' => 'backend-developer',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'UI/UX Designer',
                'created_at' => '2019-01-16 04:41:05',
                'updated_at' => '2019-01-16 04:41:05',
                'slug' => 'ui-ux-designer',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Mobile Developer',
                'created_at' => '2019-01-16 04:41:31',
                'updated_at' => '2019-01-16 04:41:31',
                'slug' => 'mobile-developer',
            ),
        ));
        
        
    }
}