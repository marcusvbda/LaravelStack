<?php

namespace App\Http\Filters\Cars;

use  marcusvbda\vstack\Filter;
use DB;

class CarsFilterByDate extends Filter
{
    public $component     = 'date-filter';
    public $label         = 'Data de Atualização :';
    public $placeholder   = 'Filtrar por data de Atualização';
    public $index = "created_at";

    public function apply($query, $value)
    {
        $query = $query->whereRaw((DB::raw("DATE(updated_at) = '" . date($value) . "'")));
        return $query;
    }
}
