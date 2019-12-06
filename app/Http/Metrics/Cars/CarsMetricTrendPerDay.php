<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;

class CarsMetricTrendPerDay extends Metric
{
    public $type   = "trend-graph";
    public function calculate(Request $request)
    {
        //metric logic here...
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
    
    public function ranges()
    {
        return [
            '1 Semana' => 7,
            '2 Semanas'=> 14,
            '3 Semanas'=> 21,
            '4 Semanas'=> 28
        ];
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