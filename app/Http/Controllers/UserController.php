<?php

namespace App\Http\Controllers;

use App\Imports\KaryawanImport;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;

class UserController extends Controller
{
    //Karyawan

    public function index()
    {
        $karyawans = User::all();

        return view('dashboard.karyawan.index')->with('karyawans', $karyawans);
    }

    public function import(Request $request)
    {
        // dd(1);
        // dd($request->all());

        Excel::import(new KaryawanImport(), $request->file('file'));


        return redirect()->back();
    }
}
