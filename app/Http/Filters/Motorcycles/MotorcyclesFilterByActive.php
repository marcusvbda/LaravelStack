<?php

namespace App\Http\Filters\Motorcycles;

use  App\vStack\Filter;

class MotorcyclesFilterByActive extends Filter
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
