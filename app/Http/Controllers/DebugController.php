<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DebugController extends Controller
{
    public function index()
    {
        // $this->testNotification();
    }

    private function testNotification()
    {
        \App\vStack\Services\Messages::notify("success","test 1234",1);
    }
}
