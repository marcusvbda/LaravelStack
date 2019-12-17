<?php
namespace App\Http\Models;
use marcusvbda\vstack\Models\DefaultModel;
class Image extends DefaultModel
{
    protected $table = "images";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];

    public static function hasTenant() 
    {
        return false;
    }
}