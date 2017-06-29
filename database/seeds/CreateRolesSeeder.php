<?php

use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->save();

        $user = new \App\Role();
        $user->name = 'user';
        $user->display_name = "User";
        $user->save();
    }
}
