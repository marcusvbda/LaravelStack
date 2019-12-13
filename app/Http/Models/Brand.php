<?php

namespace App\Http\Models;

use marcusvbda\vstack\Models\DefaultModel;
use Motorcycles;

class Brand extends DefaultModel
{
    protected $table = "brands";
    // public $cascadeDeletes = [];
    public $restrictDeletes = ['cars', "motorcycles"];
    // public static function hasTenant() //default true
    // {
    //     return true;
    // }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class);
    }
}
