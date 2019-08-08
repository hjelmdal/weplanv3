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
        if (App::Environment() === 'local') {
            $this->call(WeDeclineCategoriesTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(AdminUsersTableSeeder::class);
            $this->call(WeActivityTypesTableSeeder::class);
            $this->call(WeTeamsTableSeeder::class);
        }

        if (App::Environment() === 'dev') {
            $this->call(WeDeclineCategoriesTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(AdminUsersTableSeeder::class);
            $this->call(WeActivityTypesTableSeeder::class);
            $this->call(WeTeamsTableSeeder::class);
        }

        if (App::Environment() === 'production') {
            $this->call(WeDeclineCategoriesTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(AdminUsersTableSeeder::class);
        }
    }
}
