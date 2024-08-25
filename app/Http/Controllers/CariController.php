<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CariController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.cari.index');
    }
}
