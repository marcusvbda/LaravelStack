<?php

namespace App\vStack\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\hasCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\vStack\Traits\CascadeOrRestrictSoftdeletes;
use App\vStack\Models\Scopes\TenantScope;
use App\vStack\Models\Observers\TenantObserver;

class DefaultTenantModel extends Model
{
    use hasCode, SoftDeletes, CascadeOrRestrictSoftdeletes;
    public $guarded = ["created_at"];
    public $cascadeDeletes = [];
    public $restrictDeletes = [];

    public static function boot()
    {
        parent::boot();
        static::observe(new TenantObserver());
        static::addGlobalScope(new TenantScope());
    }
}
