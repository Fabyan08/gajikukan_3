<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class ChartOfAccountController extends Controller
{
    public function index()
    {
        $coa = ChartOfAccount::all();
        return view('dashboard.chart-account.index', compact('coa'));
    }
}
