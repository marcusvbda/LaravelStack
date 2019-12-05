<?php
namespace App\Http\Models;
use App\vStack\Models\DefaultTenantModel;
class brands extends DefaultTenantModel
{
    protected $table = "brands";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];
}