<?php

namespace App\Http\Models;

use App\vStack\Models\DefaultModel;

class ExampleRelation extends DefaultModel
{
    protected $table = "example_relation";
    // public $cascadeDeletes = ['examples'];
    public $restrictDeletes = ['examples'];

    public function examples()
    {
        return $this->hasMany(Example::class, "example_relation_id", "id");
    }
}
