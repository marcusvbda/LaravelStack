<?php

use Illuminate\Database\Seeder;
use App\Http\Models\{Example, ExampleRelation};
// use DB;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table("example_relation")->truncate();
        for ($i = 1; $i <= 10; $i++) {
            ExampleRelation::create(["name" => uniqid()]);
        }
        DB::table("example")->truncate();
        for ($i = 1; $i <= 100; $i++) {
            Example::create(["name" => "lorem ipsum " . $i, "example_relation_id" => rand(1, 10), "active" => (rand(0, 1) === 1)]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
