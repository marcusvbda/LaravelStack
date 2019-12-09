<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;
use App\Http\Models\Car;

class CarsMetricPerActive extends Metric
{
    public $type   = "group-chart";
    public function calculate(Request $request)
    {
        return [
            "Ativos"   => Car::where("active",true)->count(),
            "Inativos" => Car::where("active",false)->count(),
        ];
    }

    public function updateTime()
    {
        return 60; //60 seconds
    }
    

    public function uriKey()
    {
        return "cars-metric-per-active";
    }
}