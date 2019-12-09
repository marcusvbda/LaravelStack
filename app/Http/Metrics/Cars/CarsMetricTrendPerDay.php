<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;
use App\Http\Models\{Car,Brand};
use DB;
use Carbon\Carbon;

class CarsMetricTrendPerDay extends Metric
{
    public $type   = "trend-chart";
    public function calculate(Request $request)
    {
        return $this->getResult($request["range"]);
    }

    public function label()
    {
        return "<b>Carros por Dia</b>";
    }

    public function width()
    {
        return "col-md-8 col-sm-12";
    }

    public function uriKey()
    {
        return "cars-metric-trend-per-day";
    }

    private function getResult($range)
    {
        $startDate = Carbon::create($range[0])->format("Y-m-d 00:00:00");
        $endDate   = Carbon::create($range[1])->format("Y-m-d 00:00:00");
        $query = Car::whereRaw(DB::raw("DATE(created_at) >='$startDate'" . " and " ."DATE(created_at) <='$endDate'" ))
                    ->select(DB::raw('DATE_FORMAT(created_at,"%d/%m/%Y") as formated_date, count(*) as qty'))
                    ->groupBy("formated_date")
                    ->pluck('qty','formated_date');
        return $query;
    }
}