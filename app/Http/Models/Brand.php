<?php

namespace App\Http\Models;

use marcusvbda\vstack\Models\DefaultModel;
class Brand extends DefaultModel
{
    protected $table = "brands";
    // public $cascadeDeletes = [];
    public $restrictDeletes = ['cars', "motorcycles"];
    
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class);
    }
}
