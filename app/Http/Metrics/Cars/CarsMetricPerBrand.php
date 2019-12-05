<?php

namespace App\Http\Metrics\Cars;

use App\vStack\Metric;
use App\Http\Models\{Car,Brand};

class CarsMetricPerBrand extends Metric
{
    public $type = "group-graph";
    public function calculate() 
    {
        return $this->getCarsPerBrand();
    }

    public function label()
    {
        return "<div class='d-flex flex-row justify-content-between mb-2'>
                    <div><b>Carros Por Marca</b></div>
                    <div>Total : ".Car::count()."</div>
                </div>";
    }

    public function width()
    {
        return "col-md-4 col-sm-12";
    }
    
    //custom
    private function getCarsPerBrand()
    {
        $values = [];
        foreach(Brand::all() as $brand) 
        {
            $values[$brand->name] = Car::where("brand_id",$brand->id)->count();
        }
        return $values;
    }
    
}
