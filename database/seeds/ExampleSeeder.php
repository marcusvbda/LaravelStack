<?php

use Illuminate\Database\Seeder;
use App\Models\{Example, ExampleRelation};

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExampleRelation::truncate();
        for ($i = 1; $i <= 10; $i++) {
            ExampleRelation::create(["name" => uniqid()]);
        }
        Example::truncate();
        for ($i = 1; $i <= 1000; $i++) {
            Example::create(["name" => "lorem ipsum " . $i, "example_relation_id" => rand(1, 10), "active" => (rand(0, 1) === 1)]);
        }
    }
}
