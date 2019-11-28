<?php

namespace App\vStack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\hasCode;

class DefaultModel extends Model
{
    use hasCode, SoftDeletes;
    public $guarded = ["created_at"];
}
