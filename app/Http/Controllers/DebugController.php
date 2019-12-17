<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DebugController extends Controller
{
    public function index()
    {
        // dd(\App\Http\Models\Car::first()->images);

        // $this->testNotification();
    }

    private function testNotification()
    {
        \marcusvbda\vstack\Services\Messages::notify("success","test 1234",1);
    }
}
