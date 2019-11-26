<?php

namespace App\vStack\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\hasCode;
use Carbon\Carbon;

class DefaultModel extends Model
{
    use hasCode, SoftDeletes;
    public $guarded = ["created_at"];

    public function getCreatedAtAttribute($timestamp)
    {
        return Carbon::parse($timestamp)->format('d/m/Y - H:i:s');
    }
}
