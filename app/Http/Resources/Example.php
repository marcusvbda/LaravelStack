<?php

namespace App\Http\Resources;

use App\vStack\Resource;
use App\Http\Filters\Example\{ExampleFilterByName, ExampleFilterByRelation, ExampleFilterByActive, ExampleFilterByDate, ExampleFilterByRangeDate};
use App\vStack\Fields\Text;
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
            "code" => ["label" => "#", "size" => "10%", "sortable" => false],
            "name" => ["label" => "Nome"],
            "relation->name" => ["label" => "Relacionamento", "sortable" => true, "sortable_index" => "example_relation_id"],
            "f_active" => ["label" => "Ativo", "sortable" => true, "sortable_index" => "active"],
            "created_at" => ["label" => "Data de Criação", "size" => "20%"],
        ];
    }

    public function fields()
    {
        return [
            new Text([
                "label" => "<b>Nome</b>", "field" => "name", "required" => true, "prepend" => "<span class='text-primary'>A</span>",
                "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255"
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
