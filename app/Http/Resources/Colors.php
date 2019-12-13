<?php
namespace App\Http\Resources;
use marcusvbda\vstack\Resource;
class Colors extends Resource
{
    public $model = "App\Http\Models\Color";

    public function label()
    {
        return "Cores";
    }

    public function SingularLabel()
    {
        return "Cor";
    }

    public function icon()
    {
        return "el-icon-picture-outline-round";
    }

    public function table() 
    {
        return [
            "name" => ["label"=>"Nome"]
        ];
    }

    
}