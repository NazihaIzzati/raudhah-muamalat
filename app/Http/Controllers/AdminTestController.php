<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTestController extends Controller
{
    public function testCdn()
    {
        return view('layouts.admin-test');
    }
}
