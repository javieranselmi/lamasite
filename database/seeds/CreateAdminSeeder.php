<?php

use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role = \App\Role::where('name', 'admin')->get();
        $User = \App\User::create(['email' => 'admin@admin.com', 'name' => 'Admin', 'password' => \Illuminate\Support\Facades\Hash::make('admin')]);
        $User->attachRole($Role->get(0));
        $User->save();
    }
}
