<?php

namespace App\Http\Filters\Cars;

use  App\vStack\Filter;
use DB;

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
        $query = $query->whereRaw((DB::raw("DATE(" . $this->index . ") >='" . date($dates[0]) . "'" . " and " . DB::raw("DATE(" . $this->index . ") <='" . date($dates[1]) . "'"))));
        return $query;
    }
}
