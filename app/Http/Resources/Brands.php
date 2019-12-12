<?php

namespace App\Http\Resources;

use marcusvbda\vstack\Resource;
use marcusvbda\vstack\Fields\Text;
use marcusvbda\vstack\Fields\Card;

class Brands extends Resource
{
    public $model = "App\Http\Models\Brand";
    public function singularLabel()
    {
        return "Marca";
    }

    public function label()
    {
        return "Marcas";
    }

    public function icon()
    {
        return "el-icon-picture-outline-round";
    }

    public function table()
    {
        return [
            "name" => ["label" => "Nome", "size" => "70%"],
        ];
    }

    public function fields()
    {
        return [
            new Card("Informações",[
                new Text([
                    "label" => "Nome", "field" => "name", "required" => true,
                    "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255",
                ])
            ])
        ];
    }

    public function search()
    {
        return ["name"];
    }

}
