<?php 
namespace App\Http\Filters\Cars;
use  marcusvbda\vstack\Filter;
use \Carbon\Carbon;
use DB;

class CarsFilterByRangeDate extends Filter
{
    public $component   = "rangedate-filter";
    public $label       = "CarsFilterByRangeDate";
    public $index = "range_created_at";
    public $start_placeholder = "Data Inicio";
    public $end_placeholder = "Data Fim";
    
    public function apply($query, $value)
    {
        $dates = explode(",", $value);
        $startDate = Carbon::create($dates[0])->format("Y-m-d 00:00:00");
        $endDate   = Carbon::create($dates[1])->format("Y-m-d 00:00:00");
        $query = $query->whereRaw(DB::raw("DATE(created_at) >='$startDate'" . " and " ."DATE(created_at) <='$endDate'" ));
        return $query;
    }
}
