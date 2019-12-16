<?php

use Illuminate\Database\Seeder;
use App\Http\Models\{Car, Motorcycle, Brand,Color};
// use DB;
use Carbon\Carbon;

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
        $this->createColor();
        $this->createBrands();
        $this->createCars();
        $this->createMotorcycles();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function createColor()
    {
        DB::table("colors")->truncate();
        Color::create(["name" => "Verde","tenant_id" => 1]); //1
    }

    private function createBrands()
    {
        DB::table("brands")->truncate();
        Brand::create(["name" => "Honda","tenant_id" => 1]); //1
        Brand::create(["name" => "Kawasaki","tenant_id" => 1]); //2
        Brand::create(["name" => "Suzuki","tenant_id" => 1]); //3
        Brand::create(["name" => "Ford","tenant_id" => 1]); //4
        Brand::create(["name" => "Chevrolet","tenant_id" => 1]); //5
        Brand::create(["name" => "Fiat","tenant_id" => 1]); //6
    }

    private function createCars()
    {
        DB::table("cars")->truncate();
        Car::create(["name" => "Civic", "brand_id" => 1,"tenant_id" => 1, "active" => true,"created_at"=>Carbon::now()->subDays(rand(1,10))])->colors()->sync([1]);
        Car::create(["name" => "Focus", "brand_id" => 4,"tenant_id" => 1, "active" => false,"created_at"=>Carbon::now()->subDays(rand(1,10))])->colors()->sync([1]);
        Car::create(["name" => "Onix",  "brand_id" => 5,"tenant_id" => 1, "active" => true,"created_at"=>Carbon::now()->subDays(rand(1,10))])->colors()->sync([1]);
        Car::create(["name" => "Palio", "brand_id" => 6,"tenant_id" => 1, "active" => false,"created_at"=>Carbon::now()->subDays(rand(1,10))])->colors()->sync([1]);
    }

    private function createMotorcycles()
    {
        DB::table("motorcycles")->truncate();
    }
}
