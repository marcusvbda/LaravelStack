<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\hasCode;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable, hasCode;
    public $guarded = ['id'];
    protected $appends = ['code'];

    public function getCodeAttribute()
    {
        return \Hashids::encode($this->id);
    }
}
