<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;

class CarsMetricTrendPerDay extends Metric
{
    public $type   = "trend-graph";
    public function calculate(Request $request)
    {
        $range = $request["range"];
        // dd($range);
        return ["lorem ipsum"=>12,"lorem ipsum 2"=>11,"lorem ipsum 3"=>9];
    }

    public function label()
    {
        return "<b>Carros por Dia</b>";
    }
    
    public function updateTime()
    {
        return 60; //60 seconds
    }
    
    public function width()
    {
        return "col-md-8 col-sm-12";
    }

    public function uriKey()
    {
        return "cars-metric-trend-per-day";
    }
}