<?php

namespace App\Http\Filters\Motorcycles;

use  marcusvbda\vstack\Filter;

class MotorcyclesFilterByActive extends Filter
{
    public $component     = 'check-filter';
    public $label         = 'Ativo :';
    public $text          = 'Mostrar Apenas Ativos';
    public $index         = "active";

    public function apply($query, $value)
    {
        $query = $query->where("active", $value == "true");
        return $query;
    }
}
