<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;
use Motorcycles;

class Brand extends DefaultModel
{
    protected $table = "brands";
    // public $cascadeDeletes = ['examples'];
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
