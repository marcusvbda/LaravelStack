<?php

namespace App\vStack;

use App;

class Resource
{
    public $model          = "";
    public $id             = [];

    public function __construct()
    {
        $this->model = App::make($this->model);
        $this->makeId();
    }

    public function singularLabel()
    {
        return $this->id;
    }

    public function resultsPerPage()
    {
        return 10;
    }

    public function menu()
    {
        return "<span class='el-icon-menu mr-2'></span> Recursos";
    }

    public function globallySearchable()
    {
        return false;
    }

    public function label()
    {
        return $this->id;
    }

    public function icon()
    {
        return "";
    }

    public function table()
    {
        return ["name"];
    }

    public function filters()
    {
        return [];
    }

    public function indexLabel()
    {
        return $this->icon() . " Listagem de " . $this->label();
    }

    public function storeButtonlabel()
    {
        return "<span class='el-icon-plus mr-2'></span>Cadastrar";
    }

    public function importButtonlabel()
    {
        return "<span class='el-icon-upload2 mr-2'></span>Importar";
    }

    public function exportButtonlabel()
    {
        return "<span class='el-icon-download mr-2'></span>Exportar";
    }

    public function noResultsFoundText()
    {
        return "Nenhum resultado encontrado";
    }

    public function resultsFoundLabel()
    {
        return "Resultados encontrados : ";
    }

    public function nothingStoredText()
    {
        return "Nada cadastrado ainda...";
    }

    public function fields()
    {
        return [];
    }

    public function lens()
    {
        return [];
    }

    public function search()
    {
        return [];
    }

    public function route()
    {
        return route("resource.index", ["resource" => strtolower((new \ReflectionClass($this))->getShortName())]);
    }

    private function makeId()
    {
        $aux =  explode("/", $this->route());
        $this->id = $aux[count($aux) - 1];
    }

    public function canViewList()
    {
        return true;
    }

    public function canView()
    {
        return true;
    }

    public function canCreate()
    {
        return true;
    }

    public function canImport()
    {
        return true;
    }

    public function canExport()
    {
        return true;
    }

    public function canUpdate()
    {
        return true;
    }

    public function canDelete()
    {
        return true;
    }

    public function getValidationRule()
    {
        $validation_rules = [];
        foreach ($this->fields() as $field) {
            $validation_rules[$field->options["field"]] = $field->options["rules"];
        }
        return $validation_rules;
    }
}
