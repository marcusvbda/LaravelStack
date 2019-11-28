<?php

namespace App\Http\Resources;

use App\vStack\Resource;
use App\Http\Filters\Example\{ExampleFilterByName, ExampleFilterByRelation, ExampleFilterByActive, ExampleFilterByDate, ExampleFilterByRangeDate};
use App\vStack\Fields\{Text, Check, BelongsTo};
use Auth;

class Example extends Resource
{
    public $model = "App\Http\Models\Example";

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
            "name"                  => ["label" => "Nome", "size" => "30%"],
            "relation->name"        => ["label" => "Relacionamento", "sortable" => true, "sortable_index" => "example_relation_id"],
            "f_active"              => ["label" => "Ativo", "sortable" => true, "sortable_index" => "active"],
            "f_created_at"          => ["label" => "Data de Criação", "sortable_index" => "created_at"],
            "last_update"           => ["label" => "Ultima atualização", "sortable" => false],
        ];
    }

    public function fields()
    {
        return [
            new Text([
                "label" => "<b>Nome</b>", "field" => "name", "required" => true, "prepend" => "A",
                "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255"
            ]),
            new Check([
                "label" => "<b>Ativo</b>", "field" => "active"
            ]),
            new BelongsTo([
                "label" => "<b>Relacionamento</b>", "field" => "example_relation_id",
                "placeholder" => "Selecione um Relacionamento",
                "model" => "App\Http\Models\ExampleRelation"
            ])
        ];
    }

    public function filters()
    {
        return [
            new ExampleFilterByName,
            new ExampleFilterByRelation,
            new ExampleFilterByActive,
            new ExampleFilterByDate,
            new ExampleFilterByRangeDate
        ];
    }

    public function search()
    {
        return ["name"];
    }

    public function canViewList()
    {
        return Auth::user()->hasRole("user"); //true
    }

    public function canView()
    {
        return Auth::user()->hasRole("user"); //true
    }

    public function canCreate()
    {
        return Auth::user()->hasRole("user");  //true
    }

    public function canUpdate()
    {
        return Auth::user()->hasRole("user");  //true
    }

    public function canDelete()
    {
        return Auth::user()->hasRole("user");  //true
    }
}
