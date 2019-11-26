<?php

namespace App\Http\Resources;

use App\vStack\Resource;

class Example extends Resource
{
    public $model = "App\Models\Example";

    public function singularLabel()
    {
        return "Exemplo";
    }

    public function label()
    {
        return "Exemplos";
    }

    public function icon()
    {
        return "<b class='el-icon-s-help mr-2'></b>";
    }

    public function table()
    {
        return [
            "code" => ["label" => "Código", "size" => "10%", "sortable" => false],
            "name" => ["label" => "Nome"],
            "relation->name" => ["label" => "Relacionamento", "sortable" => true, "sortble_index" => "example_relation_id"],
            "created_at" => ["label" => "Data de Criação", "size" => "20%"],
        ];
    }

    public function filters()
    {
        return [
            "name" => ["label" => "Nome", "type" => "text", "placeholder" => "Filter por nome ..."],
        ];
    }
}
