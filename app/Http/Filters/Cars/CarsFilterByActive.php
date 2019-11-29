<?php

namespace App\Http\Filters\Cars;

use  App\vStack\Filter;

class CarsFilterByActive extends Filter
{
    public $component     = 'check-filter';
    public $label         = 'Ativo :';
    public $index         = 'active';
    public $text          = 'Mostrar Apenas Ativos';

    public function apply($query, $value)
    {
        $query = $query->where($this->index, $value == "true");
        return $query;
    }
}
