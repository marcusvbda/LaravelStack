<?php
namespace App\Http\Models;
use marcusvbda\vstack\Models\DefaultModel;
class Color extends DefaultModel
{
    protected $table = "colors";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];

    public static function hasTenant() 
    {
        return false;
    }
}