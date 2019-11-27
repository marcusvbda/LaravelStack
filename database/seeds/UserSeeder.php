<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("users")->truncate();
        $user = User::create([
            "name"     => "admin",
            "email"    => "admin@admin.com",
            "email"    => "admin@admin.com",
            "password" => bcrypt("admin"),
            "email_verified_at" => date("Y-m-d H:i:s")
        ]);
        $user->assignRole("user");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
