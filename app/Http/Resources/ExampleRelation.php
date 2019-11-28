<?php

namespace App\Http\Resources;

use App\vStack\Resource;
use App\vStack\Fields\Text;

class ExampleRelation extends Resource
{
    public $model = "App\Http\Models\ExampleRelation";
    public function singularLabel()
    {
        return "Relacionamento Exemplo";
    }

    public function label()
    {
        return "Relacionamento Exemplos";
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
            new Text([
                "label" => "<b>Nome</b>", "field" => "name", "required" => true, "prepend" => "A",
                "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255"
            ]),
        ];
    }

    public function search()
    {
        return ["name"];
    }
}
