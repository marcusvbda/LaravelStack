<?php

namespace App\vStack;

use App;

class Resource
{
    public $model          = "";
    public $route          = [];
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
        $this->id = "resource." . $aux[count($aux) - 1];
    }
}
