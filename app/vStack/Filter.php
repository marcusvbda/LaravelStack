<?php

namespace App\vStack;

class Filter
{
    public function applyFilter($query, $data)
    {
        $value = @$data[$this->index] ? @$data[$this->index] : null;
        if ($value && @$value != "null" && @$value != "false") $query = $this->apply($query, $value);
        return $query;
    }
}
