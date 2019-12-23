<?php
namespace App\Http\Models;
use marcusvbda\vstack\Models\DefaultModel;

class Tenant extends DefaultModel
{
    protected $table = "tenants";
    // public $cascadeDeletes = [];
    public $restrictDeletes = ["brands","cars","motorcycles"];
    
    public static function hasTenant() //default true
    {
        return false;
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