<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;

class Example extends DefaultModel
{
    protected $table = "example";

    public $appends = ["f_active"];

    protected  $casts = [
        "active" => "boolean"
    ];

    public function getFActiveAttribute()
    {
        return $this->active ? '<span class="badge badge-primary">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>';
    }

    public function relation()
    {
        return $this->belongsTo(ExampleRelation::class, "example_relation_id");
    }
}
