<?php 
namespace App\Http\Metrics\Cars;
use  marcusvbda\vstack\Metric;
use Illuminate\Http\Request;
use App\Http\Models\{Car,Brand};

class CarsMetricPerBrand extends Metric
{
    public $type   = "group-chart";
    public function calculate(Request $request)
    {
        $values = [];
        foreach(Brand::all() as $brand) 
        {
            $values[$brand->name] = Car::where("brand_id",$brand->id)->count();
        }
        return $values;
    }

    public function label()
    {
        return "<b>Carros Por Marca</b>";
    }

    public function sublabel()
    {
        return "<b>Total : ".Car::count()."</b> ";
    }

    public function uriKey()
    {
        return "cars-metric-per-brand";
    }

}