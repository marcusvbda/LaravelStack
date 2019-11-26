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
        return "";
    }

    public function label()
    {
        return "";
    }

    public function icon()
    {
        return "";
    }

    public function table()
    {
        return [];
    }

    public function filters()
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

    public function canView()
    {
        return false;
    }

    public function canCreate()
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
