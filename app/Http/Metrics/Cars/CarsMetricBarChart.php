<?php 
namespace App\Http\Metrics\Cars;
use  marcusvbda\vstack\Metric;
use Illuminate\Http\Request;

class CarsMetricBarChart extends Metric
{
    public $type   = "bar-chart";
    public function calculate(Request $request)
    {
        //return data or html content here...
        return ["lorem ipsum" => 12,"ipsum lorem" => 55];
    }
    
    //time to update content
    public function updateTime()
    {
        return 60; // seconds
    }
    
    public function ranges()
    {
        return "date-interval";
        //return [];
    }

    //required and unique
    public function uriKey()
    {
        return "cars-metric-bar-chart";
    }
}