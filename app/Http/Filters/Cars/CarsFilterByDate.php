<?php

namespace App\Http\Filters\Cars;

use  marcusvbda\vstack\Filter;
use DB;

class CarsFilterByDate extends Filter
{
    public $component     = 'date-filter';
    public $label         = 'Data de Atualização :';
    public $index         = 'updated_at';
    public $placeholder   = 'Filtrar por data de Atualização';

    public function apply($query, $value)
    {
        $query = $query->whereRaw((DB::raw("DATE(" . $this->index . ") = '" . date($value) . "'")));
        return $query;
    }
}
