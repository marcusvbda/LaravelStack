<?php
namespace App\Http\Models;
use App\vStack\Models\DefaultModel;

class Tenant extends DefaultModel
{
    protected $table = "tenants";
    // public $cascadeDeletes = [];
    public $restrictDeletes = ["brands","cars","motorcycles"];

    public static function ignoreTenant()
    {
        return true;
    }

    public function brands()
    {
        return $this->hasMany(Car::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function motorcycles()
    {
        return $this->hasMany(Motorcycle::class);
    }

}