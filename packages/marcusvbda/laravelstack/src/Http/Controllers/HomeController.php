<?php

namespace marcusvbda\laravelstack\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view("laravelstack::home");
    }
}
