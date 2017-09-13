<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateRolesSeeder::class);
        $this->call(CreateAdminSeeder::class);
        $this->call(CreateTextsSeeder::class);
        $this->call(CreateNotificationConfigurationsSeeder::class);
    }
}
