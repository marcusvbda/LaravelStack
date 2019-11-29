<?php

namespace App\Http\Filters\Cars;

use  App\vStack\Filter;

class CarsFilterByName extends Filter
{
    public $component   = 'text-filter';
    public $label       = 'Nome :';
    public $index       = 'name';
    public $placeholder = 'Filtre por nome ...';

    public function apply($query, $value)
    {
        $query = $query->where("name", "like", "%" . $value . "%");
        return $query;
    }
}
