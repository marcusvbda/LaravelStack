<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;
use App\Http\Models\{Car,Brand};

class CarsMetricPerBrand extends Metric
{
    public $type   = "group-graph";
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
        return "<div class='d-flex flex-row justify-content-between mb-2'>
                    <div><b>Carros Por Marca</b></div>
                    <div>Total : ".Car::count()."</div>
                </div>";
    }

    public function uriKey()
    {
        return "cars-metric-per-brand";
    }

    public function updateTime()
    {
        return 60; //seconds
    }

}