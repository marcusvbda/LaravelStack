<?php

namespace App\Http\Resources;

use marcusvbda\vstack\Resource;
use App\Http\Filters\Cars\{
    CarsFilterByName, 
    CarsFilterByDate, 
    CarsFilterByRangeDate
};
use marcusvbda\vstack\Fields\{
    Text, 
    TextArea, 
    Check, 
    BelongsTo, 
    BelongsToMany, 
    Summernote
};
use marcusvbda\vstack\Fields\Card;
use App\Http\Metrics\Cars\{
    CarsMetricCustom,
    CarsMetricPerBrand,
    CarsMetricCountPerDay,
    CarsMetricTrendPerDay,
    CarsMetricBarChart
};

use Auth;

class Cars extends Resource
{
    public $model = \App\Http\Models\Car::class;

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
        return "el-icon-s-help";
    }

    public function menu()
    {
        return "Automotores";
    }
    
    public function menuIcon()
    {
        return "el-icon-s-promotion";
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
                    "label" => "Nome", 
                    "field" => "name", 
                    "required" => true,
                    "placeholder" => "Digite o nome aqui ...", 
                    "rules" => "required|max:255"
                ]),
                new TextArea([
                    "label" => "Descrição Simples", 
                    "field" => "simple_description",
                    "placeholder" => "Digite o texto aqui ...",
                ]),
                new Summernote([
                    "label" => "Descrição Completa", 
                    "field" => "description",
                    "placeholder" => "Digite o texto aqui ...",
                ]),
            ]),
            new Card("Section Card 2",[
                new Check([
                    "label" => "Ativo", 
                    "field" => "active"
                ])
            ]),
            new Card("Section Card 3",[
                new BelongsTo([
                    "label" => "Marca", "field" => "brand_id",
                    "placeholder" => "Selecione a marca",
                    "model" => \App\Http\Models\Brand::class,
                    "rules" => "required",
                ]),
                new BelongsToMany([
                    "label" => "Cores Disponíveis" , 
                    "model" => \App\Http\Models\Color::class,
                    "field" => "colors",
                    "placeholder" => "Selecione as cores disponíveis",
                    "rules" => "required",
                ]),
            ])
        ];
    }

    public function filters()
    {
        return [
            new CarsFilterByName,
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
            new CarsMetricCountPerDay,
            new CarsMetricBarChart
        ];
    }

    //parametros para custom metric card
    public function customMetricOptions()
    {
        return [
            "group-chart" => [
                ["name" => "Marca","id"=>"brand->name","key"=>"brand_id"],
                ["name" => "Atividade","id"=>"active"]
            ],
            "trend-chart" => [
                ["name"=>"Data de Criação","id"=>"created_at"],
                ["name"=>"Data de Alteração","id"=>"updated_at"]
            ],
            "bar-chart" => [
                ["name"=>"Data de Criação","id"=>"created_at"],
                ["name"=>"Data de Alteração","id"=>"updated_at"]
            ]
        ];
    }

    // public function canViewList() //default true
    // public function canView()  //default true
    // public function canCreate() //default true
    // public function canExport() //default true
    // public function canImport() //default true
    // public function canUpdate() //default true
    // public function canDelete() //default true

    public function canCustomizeMetrics() //default false
    {
        return true;
    }
}
