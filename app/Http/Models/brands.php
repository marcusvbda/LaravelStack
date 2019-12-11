<?php
namespace App\Http\Models;
use marcusvbda\vstack\Models\DefaultTenantModel;
class brands extends DefaultTenantModel
{
    protected $table = "brands";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];
}