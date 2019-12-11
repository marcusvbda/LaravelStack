<?php

namespace App\vStack\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\hasCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\vStack\Traits\CascadeOrRestrictSoftdeletes;

class DefaultModel extends Model
{
    use hasCode, SoftDeletes, CascadeOrRestrictSoftdeletes;
    public $guarded = ["created_at"];
    public $cascadeDeletes = [];
    public $restrictDeletes = [];
}
