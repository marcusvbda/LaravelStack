<?php

use Illuminate\Database\Seeder;
use App\Models\Example;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Example::truncate();
        for ($i = 1; $i <= 1000; $i++) {
            Example::create(["name" => "lorem ipsum " . $i]);
        }
    }
}
