<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CountriesTableSeeder::class);
         $this->call(StatesTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
        $this->call(FreelancersTableSeeder::class);
        $this->call(FreelanceTitlesTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PortfoliosTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FreelancerSkillsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
    }
}
