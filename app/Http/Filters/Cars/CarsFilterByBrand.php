<?php

namespace App\Http\Filters\Cars;

use  App\vStack\Filter;
use App\Http\Models\Brand;

class CarsFilterByBrand extends Filter
{
    public $component   = 'select-filter';
    public $label       = 'Marca :';
    public $index       = 'brand_id';
    public $placeholder = 'Filtre por marca ...';

    public function __construct()
    {
        $this->options = Brand::select(["id as value", "name as label"])->get();
        parent::__construct();
    }

    public function apply($query, $value)
    {
        $query = $query->where($this->index, $value);
        return $query;
    }
}
