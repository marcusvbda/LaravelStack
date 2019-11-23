<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class AccountController extends Controller
{
    public function index(User $user)
    {
        return view("admin.account.index", compact("user"));
    }
}
