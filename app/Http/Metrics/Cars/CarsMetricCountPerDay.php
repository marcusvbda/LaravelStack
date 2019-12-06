<?php 
namespace App\Http\Metrics\Cars;
use  App\vStack\Metric;
use Illuminate\Http\Request;
use App\Http\Models\{Car};
use Carbon\Carbon;
use DB;

class CarsMetricCountPerDay extends Metric
{
    public $type   = "simple-counter";
    public function calculate(Request $request)
    {
        return [
            "value" => $this->getQty($request["range"]),
            "average" => $this->getOverage()
        ];
    }

    public function ranges()
    {
        return [
            "1 dia"      => 1,
            "10 dias"    => 10,
            "15 dias"    => 15,
            "30 dias"    => 30,
            "45 dias"    => 45,
        ];
    }
    
    public function updateTime()
    {
        return 60;//seconds
    }
    
    public function label()
    {
        return "<div class='d-flex flex-row justify-content-start mb-2'>
                    <div><b>Novos Carros Por Intervalo</b></div>
                </div>";
    }

    public function uriKey()
    {
        return "cars-metric-count-per-day";
    }

    private function getQty($range)
    {
        $days = $range;
        $startDate = Carbon::now()->subDays($days)->format("Y-m-d 00:00:00");
        $endDate = Carbon::now()->format("Y-m-d 00:00:00");
        $qty = Car::whereRaw(DB::raw("DATE(created_at) >='$startDate'" . " and " ."DATE(created_at) <='$endDate'" ))->count();
        return $qty;
    }

    private function getOverage()
    {
        $qty = 0;
        foreach($this->ranges() as $range)
        {
            $qty+= $this->getQty($range);
        }
        return $qty/Car::count();
    }
}