<?php

namespace App\Http\Resources;

use App\vStack\Resource;
use App\Http\Filters\Cars\{CarsFilterByName, CarsFilterByBrand, CarsFilterByActive, CarsFilterByDate, CarsFilterByRangeDate};
use App\vStack\Fields\{Text, TextArea, Check, BelongsTo};
use Auth;

class Cars extends Resource
{
    public $model = "App\Http\Models\Car";

    public function singularLabel()
    {
        return "Carro";
    }

    public function label()
    {
        return "Carros";
    }

    public function globallySearchable()
    {
        return true;
    }

    public function icon()
    {
        return "<b class='el-icon-s-help mr-2'></b>";
    }

    public function table()
    {
        return [
            "name"                  => ["label" => "Nome", "size" => "30%"],
            "brand->name"           => ["label" => "Marca", "sortable" => true, "sortable_index" => "brand_id"],
            "f_active"              => ["label" => "Ativo", "sortable" => true, "sortable_index" => "active"],
            "f_created_at"          => ["label" => "Data de Criação", "sortable_index" => "created_at"],
            "last_update"           => ["label" => "Ultima atualização", "sortable" => false],
        ];
    }

    public function fields()
    {
        return [
            new Text([
                "label" => "<b>Nome</b>", "field" => "name", "required" => true,
                "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255"
            ]),
            new TextArea([
                "label" => "<b>Descrição</b>", "field" => "description",
                "placeholder" => "Digite o texto aqui ...",
            ]),
            new Check([
                "label" => "<b>Ativo</b>", "field" => "active"
            ]),
            new BelongsTo([
                "label" => "<b>Marca</b>", "field" => "brand_id",
                "placeholder" => "Selecione a marca",
                "model" => "App\Http\Models\Brand",
                "rules" => "required"
            ])
        ];
    }

    public function filters()
    {
        return [
            new CarsFilterByName,
            new CarsFilterByBrand,
            new CarsFilterByActive,
            new CarsFilterByDate,
            new CarsFilterByRangeDate
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
