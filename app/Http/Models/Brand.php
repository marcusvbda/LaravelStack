<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultTenantModel;
use Motorcycles;

class Brand extends DefaultTenantModel
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
