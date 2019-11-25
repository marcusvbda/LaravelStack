<?php

namespace App\Http\Resources;

class Example extends Resource
{
    public $model        = "App\Models\Example";
    public $title        = "Exemplo"; //optional
    public $plural_title = "Exemplos"; //optional
    public $icon         = "<b class='el-icon-s-help mr-2'></b>"; //optional
    public $table        = [
        "code" => ["label" => "Código", "size" => "10%", "sortable" => false],
        "name" => ["label" => "Nome"],
        "created_at" => ["label" => "Data de Criação", "size" => "20%"],
    ];

    public $filters        = [
        "name" => ["label" => "Nome", "type" => "text", "placeholder" => "Filter por nome ..."],
    ];
}
