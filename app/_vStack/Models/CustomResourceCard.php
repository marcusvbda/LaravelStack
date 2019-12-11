<?php
namespace App\vStack\Models;
use App\vStack\Models\DefaultTenantModel;
use App\vStack\Models\Scopes\UserScope;
use App\vStack\Models\Observers\UserObserver;

class CustomResourceCard extends DefaultTenantModel
{
    protected $table = "custom_resource_cards";
    // public $cascadeDeletes = [];
    // public $restrictDeletes = [];

    public static function boot()
    {
        parent::boot();
        static::observe(new UserObserver());
        static::addGlobalScope(new UserScope());
    }
}