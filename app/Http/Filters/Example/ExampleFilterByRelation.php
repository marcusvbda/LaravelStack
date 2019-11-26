<?php

namespace App\Http\Filters\Example;

use  App\vStack\Filter;
use App\Http\Models\ExampleRelation;
use ExampleRelation as GlobalExampleRelation;

class ExampleFilterByRelation extends Filter
{
    public $component   = 'select-filter';
    public $label       = 'Relacionamento :';
    public $index       = 'example_relation_id';
    public $placeholder = 'Filtre por relacionameto ...';

    public function __construct()
    {
        $this->options = ExampleRelation::select(["id as value", "name as label"])->get()->toArray();
    }

    public function apply($query, $value)
    {
        $query = $query->where($this->index, $value);
        return $query;
    }
}
