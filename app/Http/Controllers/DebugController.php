<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\vStack\Services\Messages;

class DebugController extends Controller
{
    public function index()
    {
        Messages::notify("success","teste 1234",1);
    }
}
