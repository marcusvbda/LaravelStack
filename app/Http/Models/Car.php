<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;

class Car extends DefaultModel
{
    protected $table = "cars";

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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}