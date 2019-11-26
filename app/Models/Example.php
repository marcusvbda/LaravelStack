<?php

namespace App\Models;

use App\vStack\Models\DefaultModel;

class Example extends DefaultModel
{
    protected $table = "example";

    public function relation()
    {
        return $this->belongsTo(ExampleRelation::class, "example_relation_id");
    }
}
