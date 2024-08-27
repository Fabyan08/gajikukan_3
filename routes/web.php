<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CariController;
use App\Http\Controllers\ChartOfAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKaryawansController;
use App\Http\Controllers\DataPengurusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KantorCabang\DataCabangGajiKaryawansController;
use App\Http\Controllers\KantorCabang\DataCabangGajiPengurusPengawasController;
use App\Http\Controllers\KantorCabang\DataCabangKaryawansController;
use App\Http\Controllers\KantorCabang\DataCabangNonaktifKaryawanPengurusController;
use App\Http\Controllers\KantorCabang\DataCabangPengurusPengawasController;
use App\Http\Controllers\KantorCabang\DataGajiKaryawansController;
use App\Http\Controllers\KantorCabangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\PphController;
use App\Http\Controllers\TambahKantorCabangController;
use App\Http\Controllers\TidakAktifController;
use App\Http\Controllers\UploadKaryawanController;
use App\Http\Controllers\UploadPengurusPengawas;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', function () {
    return response('Not Found', 404);
})->name('register');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


Route::middleware('auth', 'check.status:Aktif')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update_profile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Route::get('/admin/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::put('admin/deactivate/{id}', [AdminController::class, 'deactivate'])->name('admin.deactivate');
    Route::put('admin/activate/{id}', [AdminController::class, 'activate'])->name('admin.activate');

    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');


    // Tes excel
    Route::post('/import_proses', [AdminController::class, 'import_proses'])->name('admin.import_proses');


    // Waktu
    Route::post('/waktu', [UploadKaryawanController::class, 'store_waktu'])->name('upload.store_waktu');

    Route::post('/waktu-pengurus', [UploadPengurusPengawas::class, 'store_waktu'])->name('upload-pengurus.store_waktu');

    // Karyawan
    Route::get('/karyawan', [UserController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan_import', [UserController::class, 'import'])->name('karyawan.import');


    // Slip Gaji Karyawan
    Route::get('/upload/gaji-karyawan', [UploadKaryawanController::class, 'index'])->name('upload-gaji-karyawan.index');
    Route::get('/upload/gaji-karyawan/detail/{id}', [UploadKaryawanController::class, 'detail'])->name('upload.detail');
    Route::post('/gaji_import/gaji-karyawan', [UploadKaryawanController::class, 'import'])->name('gaji.import');
    Route::get('/upload/gaji-karyawan/detail-gaji/{id_waktu}/{id}', [UploadKaryawanController::class, 'detail_gaji'])->name('gaji.detail');
    Route::get('/slip-gaji/gaji-karyawan/{id_waktu}/{id}', [UploadKaryawanController::class, 'print_slip'])->name('gaji.print_slip');
    Route::delete('/slip-gaji/gaji-karyawan/{id_waktu}', [UploadKaryawanController::class, 'delete'])->name('gaji.delete');
    Route::delete('/slip-gaji/gaji-karyawan/delete-all/{id_waktu}', [UploadKaryawanController::class, 'delete_waktus'])->name('gaji.delete_waktus');
    Route::put('/slip-gaji/gaji-karyawan/update/{id_waktu}/{id}', [UploadKaryawanController::class, 'update'])->name('gaji.update');

    // Slip Gaji Pengurus & Pengawas
    Route::get('/upload/gaji-pengurus', [UploadPengurusPengawas::class, 'index'])->name('upload.index');
    Route::get('/upload/gaji-pengurus/detail/{id}', [UploadPengurusPengawas::class, 'detail'])->name('upload-pengurus.detail');
    Route::post('/gaji_import/gaji-pengurus', [UploadPengurusPengawas::class, 'import'])->name('gaji-pengurus.import');
    Route::get('/upload/gaji-pengurus/detail-gaji/{id_waktu}/{id}', [UploadPengurusPengawas::class, 'detail_gaji'])->name('gaji-pengurus.detail');
    Route::get('/slip-gaji/gaji-pengurus/{id_waktu}/{id}', [UploadPengurusPengawas::class, 'print_slip'])->name('gaji-pengurus.print_slip');
    Route::delete('/slip-gaji/gaji-pengurus/{id_waktu}', [UploadPengurusPengawas::class, 'delete'])->name('gaji-pengurus.delete');
    Route::delete('/slip-gaji/gaji-pengurus/delete-all/{id_waktu}', [UploadPengurusPengawas::class, 'delete_waktus'])->name('gaji-pengurus.delete_waktus');

    Route::put('/slip-gaji/gaji-pengawas/update/{id_waktu}/{id}', [UploadPengurusPengawas::class, 'update'])->name('gaji-pengurus.update');

    // HR Karyawan
    Route::get('/karyawan', [DataKaryawansController::class, 'index'])->name('data-karyawan.index');
    Route::post('/karyawan/import', [DataKaryawansController::class, 'import'])->name('data-karyawan.import');
    Route::delete('/karyawan/delete_all', [DataKaryawansController::class, 'delete'])->name('data-karyawan.delete');
    Route::put('/karyawan/nonaktifkan/{id}', [DataKaryawansController::class, 'nonaktif'])->name('data-karyawan.nonaktif');
    Route::put('/karyawan/update/{id}', [DataKaryawansController::class, 'update'])->name('data-karyawan.update');
    Route::post('/karyawan/insert', [DataKaryawansController::class, 'insert'])->name('data-karyawan.insert');
    Route::delete('/karyawan/delete/{id}', [DataKaryawansController::class, 'delete_id'])->name('data-karyawan.delete_id');
    // HR Pengurus & Pengawas
    Route::get('/pengurus-pengawas', [DataPengurusController::class, 'index'])->name('data-pengurus_pengawas.index');
    Route::post('/pengurus-pengawas/import', [DataPengurusController::class, 'import'])->name('data-pengurus_pengawas.import');
    Route::delete('/pengurus-pengawas/delete_all', [DataPengurusController::class, 'delete'])->name('data-pengurus_pengawas.delete');
    Route::put('/pengurus-pengawas/nonaktifkan/{id}', [DataPengurusController::class, 'nonaktif'])->name('data-pengurus_pengawas.nonaktif');
    Route::put('/pengurus-pengawas/update/{id}', [DataPengurusController::class, 'update'])->name('data-pengurus_pengawas.update');
    Route::post('/pengurus-pengawas/insert', [DataPengurusController::class, 'insert'])->name('data-pengurus_pengawas.insert');
    Route::delete('/pengurus-pengawas/delete_id/{id}', [DataPengurusController::class, 'delete_id'])->name('data-pengurus_pengawas.delete_id');

    // Tidak Aktif
    Route::get('/tidak-aktif', [TidakAktifController::class, 'index'])->name('tidak-aktif.index');
    Route::put('/aktifkan/{id}', [TidakAktifController::class, 'aktifkan'])->name('aktifkan');

    // Cari Data
    Route::get('/cari-data', [CariController::class, 'index'])->name('cari.index');


    // Tambah Kantor
    Route::get('/tambah-kantor', [TambahKantorCabangController::class, 'index'])->name('tambahkantor.index');
    Route::post('/tambah-kantor', [TambahKantorCabangController::class, 'store'])->name('tambahkantor.store');
    Route::delete('/tambah-kantor-delete', [TambahKantorCabangController::class, 'destroy'])->name('tambahkantor.destroy');


    Route::get('/detail-kantor-cabang/{slug}', [KantorCabangController::class, 'show'])->name('detail.kantor');

    // Kantor Cabang Karyawan
    Route::get('/kantor-cabang/data-karyawan/{slug}', [DataCabangKaryawansController::class, 'data_karyawan'])->name('kantor-cabang.karyawan');
    Route::post('/kantor-cabang/data-karyawan', [DataCabangKaryawansController::class, 'insert_karyawan'])->name('kantor-cabang.insert_karyawan');
    Route::delete('/kantor-cabang/data-karyawan', [DataCabangKaryawansController::class, 'delete_karyawan'])->name('kantor-cabang.delete_karyawan');
    Route::post('/data-karyawan/import', [DataCabangKaryawansController::class, 'import_karyawan'])->name('kantor-cabang.import_karyawan');
    Route::put('/kantor-cabang/data-karyawan/update/{id}', [DataCabangKaryawansController::class, 'update'])->name('kantor-cabang.karyawan.update');
    Route::put('/kantor-cabang/data-karyawan/nonaktif/{id}', [DataCabangKaryawansController::class, 'nonaktif'])->name('kantor-cabang.gaji-karyawan.nonaktif');
    Route::delete('/kantor-cabang/data-karyawan/delete_id/{id}', [DataCabangKaryawansController::class, 'delete_id'])->name('kantor-cabang.gaji-karyawan.delete_id');

    // Kantor Cabang Pengurus Pengawas
    Route::get('/kantor-cabang/data-pengurus/{slug}', [DataCabangPengurusPengawasController::class, 'index'])->name('kantor-cabang.pengurus');
    Route::post('/kantor-cabang/data-pengurus', [DataCabangPengurusPengawasController::class, 'insert_pengurus'])->name('kantor-cabang.insert_pengurus');
    Route::delete('/kantor-cabang/data-pengurus', [DataCabangPengurusPengawasController::class, 'delete_pengurus'])->name('kantor-cabang.delete_pengurus');
    Route::post('/data-pengurus/import', [DataCabangPengurusPengawasController::class, 'import_pengurus'])->name('kantor-cabang.import_pengurus');
    Route::put('/kantor-cabang/data-pengurus/update/{id}', [DataCabangPengurusPengawasController::class, 'update'])->name('kantor-cabang.gaji-pengurus.update');
    Route::put('/kantor-cabang/data-pengurus/nonaktif/{id}', [DataCabangPengurusPengawasController::class, 'nonaktif'])->name('kantor-cabang.gaji-pengurus.nonaktif');
    Route::delete('/kantor-cabang/data-pengurus/delete_id/{id}', [DataCabangPengurusPengawasController::class, 'delete_id'])->name('kantor-cabang.gaji-pengurus.delete_id');

    // Kantor Cabang Gaji Karyawan
    Route::get('/kantor-cabang/gaji-karyawan/{slug}', [DataCabangGajiKaryawansController::class, 'index'])->name('kantor-cabang.gaji-karyawan.index');
    Route::post('/kantor-cabang/gaji-karyawan', [DataCabangGajiKaryawansController::class, 'store_waktu'])->name('kantor-cabang.gaji-karyawan.store_waktu');
    Route::delete('/kantor-cabang/gaji-karyawan/{id_waktu}', [DataCabangGajiKaryawansController::class, 'delete_waktus'])->name('kantor-cabang.gaji-karyawan.delete_waktus');
    Route::get('/kantor-cabang/gaji-karyawan/detail/{slug}/{id_waktu}', [DataCabangGajiKaryawansController::class, 'detail'])->name('kantor-cabang.gaji-karyawan.detail');
    Route::get('/kantor-cabang/gaji-karyawan/detail/{slug}/{id_waktu}/{id}', [DataCabangGajiKaryawansController::class, 'detail_gaji'])->name('kantor-cabang.gaji-karyawan.detail_gaji');
    Route::post('/kantor-cabang/gaji-karyawan/detail/{slug}/{id_waktu}', [DataCabangGajiKaryawansController::class, 'import'])->name('kantor-cabang.gaji-karyawan.import');

    Route::delete('/kantor-cabang/gaji-karyawan/detail/{id_waktu}', [DataCabangGajiKaryawansController::class, 'delete'])->name('kantor-cabang.gaji-karyawan.delete');
    Route::put('/kantor-cabang/gaji-karyawan/update/{id}{id_waktu}', [DataCabangGajiKaryawansController::class, 'update'])->name('kantor-cabang.gaji-karyawan.update');
    Route::get('/kantor-cabang/gaji-karyawan/print/{id}/{id_waktu}/{table_name}', [DataCabangGajiKaryawansController::class, 'print_slip'])->name('kantor-cabang.gaji-karyawan.print');

    // Kantor Cabang Gaji Pengurus Pengawas
    Route::get('/kantor-cabang/gaji-pengurus-pengawas/{slug}', [DataCabangGajiPengurusPengawasController::class, 'index'])->name('kantor-cabang.gaji-pengurus-pengawas.index');
    Route::post('/kantor-cabang/gaji-pengurus-pengawas', [DataCabangGajiPengurusPengawasController::class, 'store_waktu'])->name('kantor-cabang.gaji-pengurus-pengawas.store_waktu');
    Route::delete('/kantor-cabang/gaji-pengurus-pengawas/{id_waktu}', [DataCabangGajiPengurusPengawasController::class, 'delete_waktus'])->name('kantor-cabang.gaji-pengurus-pengawas.delete_waktus');
    Route::get('/kantor-cabang/gaji-pengurus-pengawas/detail/{slug}/{id_waktu}', [DataCabangGajiPengurusPengawasController::class, 'detail'])->name('kantor-cabang.gaji-pengurus-pengawas.detail');
    Route::get('/kantor-cabang/gaji-pengurus-pengawas/detail/{slug}/{id_waktu}/{id}', [DataCabangGajiPengurusPengawasController::class, 'detail_gaji'])->name('kantor-cabang.gaji-pengurus-pengawas.detail_gaji');
    Route::post('/kantor-cabang/gaji-pengurus-pengawas/detail/{slug}/{id_waktu}', [DataCabangGajiPengurusPengawasController::class, 'import'])->name('kantor-cabang.gaji-pengurus-pengawas.import');

    Route::delete('/kantor-cabang/gaji-pengurus-pengawas/detail/{id_waktu}', [DataCabangGajiPengurusPengawasController::class, 'delete'])->name('kantor-cabang.gaji-pengurus-pengawas.delete');
    Route::put('/kantor-cabang/gaji-pengurus-pengawas/update/{id}{id_waktu}', [DataCabangGajiPengurusPengawasController::class, 'update'])->name('kantor-cabang.gaji-pengurus-pengawas.update');
    Route::get('/kantor-cabang/gaji-pengurus-pengawas/print/{id}/{id_waktu}/{table_name}', [DataCabangGajiPengurusPengawasController::class, 'print_slip'])->name('kantor-cabang.gaji-pengurus-pengawas.print');

    // Nonaktif
    Route::get('/kantor-cabang/data-karyawan-nonaktif/{slug}', [DataCabangNonaktifKaryawanPengurusController::class, 'index'])->name('kantor-cabang.gaji-karyawan-nonaktif.index');
    Route::put('/kantor-cabang/data-karyawan-nonaktif/aktifkan/{id}', [DataCabangNonaktifKaryawanPengurusController::class, 'aktifkan'])->name('kantor-cabang.gaji-karyawan-nonaktif.aktifkan');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');

    // Chart of Account
    Route::get('/chart-account', [ChartOfAccountController::class, 'index'])->name('coa.index');
    Route::post('/chart-account/post', [ChartOfAccountController::class, 'create'])->name('coa.create');
    Route::get('/chart-account/{id}', [ChartOfAccountController::class, 'detail'])->name('coa.detail');
    Route::delete('/chart-account/delete/{id}', [ChartOfAccountController::class, 'delete'])->name('coa.delete');
    Route::post('/chart-account/update/{id}', [ChartOfAccountController::class, 'update'])->name('coa.update');
    Route::delete('/chart-account/delete-all', [ChartOfAccountController::class, 'delete_all'])->name('coa.delete_all');
    Route::post('/chart-account/import', [ChartOfAccountController::class, 'import'])->name('coa.import');

    // PPH
    Route::get('/pph-21', [PphController::class, 'index'])->name('pph.index');
    Route::post('/pph-21/tambah-kantor', [PphController::class, 'tambah_kantor'])->name('pph.tambah_kantor');
    Route::delete('/pph-21/delete-kantor', [PphController::class, 'hapus_kantor'])->name('pph.hapus_kantor');

    Route::get('/pph-21/pusat', [PphController::class, 'detail_pusat'])->name('pph.detail_pusat');
    Route::post('/pph-21/pusat/tambah-waktu', [PphController::class, 'store_waktu_pusat'])->name('pph.store_waktu_pusat');
    Route::delete('/pph-21/pusat/delete-waktu/{id}', [PphController::class, 'delete_waktu_pusat'])->name('pph.delete_waktu_pusat');
    Route::get('/pph-21/pusat/{id_waktu}', [PphController::class, 'index_pusat'])->name('pph.index_pusat');
    Route::post('/pph-21/pusat/tambah-data', [PphController::class, 'store_pusat'])->name('pph.store_pusat');
});
Route::middleware('auth', 'check.status:Tidak Aktif')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});
require __DIR__ . '/auth.php';
