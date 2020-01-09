<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Http\Models\Tenant;

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
        DB::table("tenants")->truncate();
        DB::table("users")->truncate();
        Tenant::create(["name"=>uniqid()]);
        $user = User::create([
            "name"     => "admin",
            "email"    => "admin@admin.com",
            "email"    => "admin@admin.com",
            "password" => "admin",
            "email_verified_at" => date("Y-m-d H:i:s"),
            "tenant_id" => 1
        ]);
        $user->assignRole("user");
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
