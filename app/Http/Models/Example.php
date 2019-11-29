<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;

class Example extends DefaultModel
{
    protected $table = "example";

    public $appends = ["f_created_at", "f_active", "last_update"];

    protected  $casts = [
        "active" => "boolean"
    ];

    public function getFActiveAttribute()
    {
        return $this->active ? '<span class="badge badge-primary">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>';
    }

    public function getLastUpdateAttribute()
    {
        if (!$this->created_at) return;
        return $this->created_at->diffForHumans();
    }

    public function getFCreatedAtAttribute()
    {
        if (!$this->created_at) return;
        return @$this->created_at->format("d/m/Y - H:i:s");
    }

    public function relation()
    {
        return $this->belongsTo(ExampleRelation::class, "example_relation_id");
    }
}
