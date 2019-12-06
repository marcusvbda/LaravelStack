<?php

namespace App\Http\Metrics\Cars;

use App\vStack\Metric;
use App\Http\Models\Brand;
use vStack;
class CarsMetricCustom extends Metric
{
    public $type = "custom-content";

    public function content() 
    {
        $day = vStack::getDay();
        return "<div class='d-flex h-100 align-items-center justify-content-center flex-column'>
                    <h2>".$day->week."</h2>
                    <h3 class='font-weight-light'>".$day->formated."</h3>
                </div>";
    }

    public function uriKey()
    {
        return 'cars-metric-custom';
    }
    
}
