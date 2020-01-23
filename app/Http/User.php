<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\hasCode;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, hasCode, HasRoles;
    public $guarded = ['id'];
    protected $appends = ['code','roleName'];

    public $casts = ["avatar"=>"array"];

    public function getCodeAttribute()
    {
        return \Hashids::encode($this->id);
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    public function setPasswordAttribute($val)
    {
        $this->attributes["password"] = bcrypt($val);
    }

    public function setNameAttribute($val)
    {
        $this->attributes["name"] = $val;
        if(Auth::check()) $this->attributes["tenant_id"] = Auth::user()->tenant_id;
    }

    public function getRoleNameAttribute()
    {
        $roles = $this->roles;
        return @$roles[0]->name;
    }
}
