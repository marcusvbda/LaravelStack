<?php

namespace App\Http\Resources;

use App;

class Resource
{
    public $model          = "";
    public $title          = "";
    public $plural_title   = "";
    public $icon           = "";
    public $table          = [];
    public $filters        = [];
    public $route          = [];
    public $id             = [];

    public function __construct()
    {
        $this->model = App::make($this->model);
        $this->plural_title = $this->plural_title ? $this->plural_title : $this->plural_title . "s";
        $this->makeRoute();
        $this->makeId();
    }

    private function makeRoute()
    {
        $this->route = route("resource.index", ["resource" => $this->route ? $this->route : strtolower((new \ReflectionClass($this))->getShortName())]);
    }

    private function makeId()
    {
        $aux =  explode("/", $this->route);
        $this->id = "resource." . $aux[count($aux) - 1];
    }
}
