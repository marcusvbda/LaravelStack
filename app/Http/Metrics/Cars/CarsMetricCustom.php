<?php

namespace App\Http\Metrics\Cars;

use App\vStack\Metric;
use App\Http\Models\Brand;
use Carbon\Carbon;

class CarsMetricCustom extends Metric
{
    public $type = "custom-content";

    public function content() 
    {
        $days_of_week = ["Domingo","Segunda-Feira","Terça-Feira","Quarta-Feira","Quinta-Feira","Sexta-Feira","Sábado"];
        $date = Carbon::now();
        return "<div class='d-flex h-100 align-items-center justify-content-center flex-column'>
                    <h1>".$days_of_week[$date->dayOfWeek]."</h1>
                    <h3 class='font-weight-light'>".$date->format("d/m/Y")."</h3>
                </div>";
    }

    public function uriKey()
    {
        return 'cars-metric-custom';
    }
    
}
