<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmsController extends Controller
{
    public function __construct()
    {
    }

    public function listFarms(Request $request)
    {
        $farms = null;
        return view('farms.list', ['farms' => $farms]);
    }
}
