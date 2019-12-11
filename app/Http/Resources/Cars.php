<?php

namespace App\Http\Resources;

use marcusvbda\vstack\Resource;
use App\Http\Filters\Cars\{CarsFilterByName, CarsFilterByBrand, CarsFilterByDate, CarsFilterByRangeDate};
use marcusvbda\vstack\Fields\{Text, TextArea, Check, BelongsTo};
use marcusvbda\vstack\Fields\Card;
use App\Http\Metrics\Cars\{CarsMetricCustom,CarsMetricPerBrand,CarsMetricCountPerDay,CarsMetricPerActive,CarsMetricTrendPerDay};

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

    public function menu()
    {
        return "<span class='el-icon-menu mr-2'></span> Automotores";
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

    public function lenses()
    {
        return [
            "Apenas Ativos" => ["field" => "active", "value" => true],
            "Apenas Inativos" => ["field" => "active", "value" => false],
        ];
    }

    public function fields()
    {
        return [
            new Card("<span class='el-icon-s-order mr-2'></span>Section Card 1",[
                new Text([
                    "label" => "Nome", "field" => "name", "required" => true,
                    "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255",
                    // "mask" => ['(##) ####-####', '(##) #####-####']
                ]),
                new TextArea([
                    "label" => "Descrição", "field" => "description",
                    "placeholder" => "Digite o texto aqui ...",
                ]),
            ]),
            new Card("Section Card 2",[
                new Check([
                    "label" => "Ativo", "field" => "active"
                ])
            ]),
            new Card("Section Card 3",[
                new BelongsTo([
                    "label" => "Marca", "field" => "brand_id",
                    "placeholder" => "Selecione a marca",
                    "model" => "App\Http\Models\Brand",
                    "rules" => "required"
                ])
            ])
        ];
    }

    public function filters()
    {
        return [
            new CarsFilterByName,
            new CarsFilterByBrand,
            new CarsFilterByDate,
            new CarsFilterByRangeDate
        ];
    }

    public function search()
    {
        return ["name"];
    }

    public function metrics()
    {
        return [
            new CarsMetricCustom,
            new CarsMetricTrendPerDay,
            new CarsMetricPerBrand,
            new CarsMetricPerActive,
            new CarsMetricCountPerDay,
        ];
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

    public function canExport()
    {
        return Auth::user()->hasRole("user");  //true
    }

    public function canImport()
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

    public function canCustomizeMetrics()
    {
        return Auth::user()->hasRole("user");  //true
    }
}
