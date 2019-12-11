<?php

namespace App\Http\Filters\Cars;

use  marcusvbda\vstack\Filter;
use DB;
use Carbon\Carbon;

class CarsFilterByRangeDate extends Filter
{
    public $component           = 'rangedate-filter';
    public $label               = 'Data de Criação :';
    public $index               = 'created_at';
    public $start_placeholder   = 'Data Início';
    public $end_placeholder     = 'Data Fim';

    public function apply($query, $value)
    {
        $dates = explode(",", $value);
        $startDate = Carbon::create($dates[0])->format("Y-m-d 00:00:00");
        $endDate   = Carbon::create($dates[1])->format("Y-m-d 00:00:00");
        $query = $query->whereRaw(DB::raw("DATE(".$this->index.") >='$startDate'" . " and " ."DATE(created_at) <='$endDate'" ));
        return $query;
    }
}
