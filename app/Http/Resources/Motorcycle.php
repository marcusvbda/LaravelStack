<?php

namespace App\Http\Resources;

use marcusvbda\vstack\Resource;
use App\Http\Filters\Motorcycles\{MotorcyclesFilterByBrand, MotorcyclesFilterByActive};
use marcusvbda\vstack\Fields\{Text, TextArea, Check, BelongsTo};
use marcusvbda\vstack\Fields\Card;
use Auth;

class Motorcycle extends Resource
{
    public $model = "App\Http\Models\Motorcycle";

    public function singularLabel()
    {
        return "Moto";
    }

    public function label()
    {
        return "Motos";
    }

    public function globallySearchable()
    {
        return true;
    }

    public function icon()
    {
        return "el-icon-s-open";
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
            new Card(null,[
                new Text([
                    "label" => "Nome", "field" => "name", "required" => true,
                    "placeholder" => "Digite o nome aqui ...", "rules" => "required|max:255"
                ]),
                new TextArea([
                    "label" => "Descrição", "field" => "description",
                    "placeholder" => "Digite o texto aqui ...",
                ]),
                new Check([
                    "label" => "Ativo", "field" => "active"
                ]),
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
            new MotorcyclesFilterByBrand,
            new MotorcyclesFilterByActive,
        ];
    }

    public function menu()
    {
        return "Automotores";
    }

    public function menuIcon()
    {
        return "el-icon-s-promotion";
    }

    public function search()
    {
        return ["name"];
    }
}
