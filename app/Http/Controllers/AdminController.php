<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\ImportExcel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Excel;
// use Maatwebsite\Excel\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $admin = User::where('level', 'admin')
            ->orderByRaw("CASE WHEN status = 'Aktif' THEN 0 ELSE 1 END")
            ->get();

        return view('dashboard.admin.index', ['admin' => $admin]);
    }

    public function inactive()
    {
        $admin = User::where('level', 'admin')->where('status', 'not active')->get();
        return view('dashboard.admin.inactive', ['admin' => $admin]);
    }
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('delete', '1 Data Admin Berhasil Dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telepon' => ['required', 'string', 'min:12'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $admin = User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->telepon,
            'password' => Hash::make($request->password),
            'level' => 'admin',
        ]);

        return redirect()->back()->with('plus', 'Admin baru ditambahkan');
    }

    public function detail($id)
    {
        $data_admin = User::where('id', $id)->first();

        return view('dashboard.admin.detail', ['admin' => $data_admin]);
    }

    public function import_proses(Request $request)
    {
        // dd($request->all());

        Excel::import(new UserImport(), $request->file('excel'));

        return redirect()->back();
    }

    public function render_excel()
    {
        $importExcels = ImportExcel::all();
        dd($importExcels);

        return view('dashboard.dashboard', ['importExcels' => $importExcels]);
    }

    public function update(Request $request, $id)
    {
        $admin = User::where('id', $id)->update([
            'nama' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->telepon,
        ]);
        return redirect()->back()->with('aktifkan', 'Berhasil Edit.');
    }

    public function deactivate($id)
    {
        $admin = User::where('id', $id)->update(['status' => 'Tidak Aktif']);
        return redirect()->back()->with('nonaktif', 'Admin Berhasil Dinonaktifkan!');
    }
    public function activate($id)
    {
        $admin = User::where('id', $id)->update(['status' => 'Aktif']);
        return redirect()->back()->with('aktifkan', 'Admin Berhasil Diaktifkan Kembali.');
    }
}
