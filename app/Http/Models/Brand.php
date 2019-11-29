<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;
use Motorcycles;

class Brand extends DefaultModel
{
    protected $table = "brands";
    // public $cascadeDeletes = ['examples'];
    public $restrictDeletes = ['examples', "motorcycles"];

    public function cars()
    {
        return $this->hasMany(Example::class);
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class);
    }
}
