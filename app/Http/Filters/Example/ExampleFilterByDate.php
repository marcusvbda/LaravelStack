<?php

namespace App\Http\Filters\Example;

use  App\vStack\Filter;
use DB;

class ExampleFilterByDate extends Filter
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
