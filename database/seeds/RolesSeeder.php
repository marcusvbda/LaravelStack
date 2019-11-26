<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        Role::create(["name" => "super-admin"]); //1
        Role::create(["name" => "admin"]); // 2
        Role::create(["name" => "user"]); //3
    }
}
