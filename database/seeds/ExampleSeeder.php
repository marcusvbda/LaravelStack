<?php

use Illuminate\Database\Seeder;
use App\Http\Models\{Car, Motorcycle, Brand};
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
        $this->createBrands();
        $this->createCars();
        $this->createMotorcycles();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function createBrands()
    {
        DB::table("brands")->truncate();
        Brand::create(["name" => "Honda"]); //1
        Brand::create(["name" => "Kawasaki"]); //2
        Brand::create(["name" => "Suzuki"]); //3
        Brand::create(["name" => "Ford"]); //4
        Brand::create(["name" => "Chevrolet"]); //5
        Brand::create(["name" => "Fiat"]); //6
    }

    private function createCars()
    {
        DB::table("cars")->truncate();
        Car::create(["name" => "Civic", "brand_id" => 1, "active" => true]);
        Car::create(["name" => "Focus", "brand_id" => 4, "active" => false]);
        Car::create(["name" => "Onix",  "brand_id" => 5, "active" => true]);
        Car::create(["name" => "Palio", "brand_id" => 6, "active" => false]);
    }

    private function createMotorcycles()
    {
        DB::table("motorcycles")->truncate();
        // Motorcycle::create(["name" => "Hornet", "brand_id" => 1, "active" => true]);
        // Motorcycle::create(["name" => "Ninja",  "brand_id" => 2, "active" => false]);
    }
}
