<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AnggotaController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/store', [AuthController::class, 'tambahAnggota'])->name('tambahAnggota');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::group(['middleware' => 'staff.session'],function () {
    Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');

    Route::get('/pengarang', [StaffController::class, 'pengarang'])->name('pengarang');
    Route::post('/tambah-pengarang', [StaffController::class, 'tambahPengarang'])->name('tambahPengarang');
    Route::post('/edit-pengarang', [StaffController::class, 'editPengarang'])->name('editPengarang');
    Route::get('/hapus-pengarang/{id}', [StaffController::class, 'hapusPengarang'])->name('hapusPengarang');

    Route::get('/penerbit', [StaffController::class, 'penerbit'])->name('penerbit');
    Route::post('/tambah-penerbit', [StaffController::class, 'tambahPenerbit'])->name('tambahPenerbit');
    Route::post('/edit-penerbit', [StaffController::class, 'editPenerbit'])->name('editPenerbit');
    Route::get('/hapus-penerbit/{id}', [StaffController::class, 'hapusPenerbit'])->name('hapusPenerbit');

    Route::get('/dashboard', [StaffController::class, 'buku'])->name('buku');
    Route::post('/tambah-buku', [StaffController::class, 'tambahBuku'])->name('tambahBuku');
    Route::post('/edit-buku', [StaffController::class, 'editBuku'])->name('editBuku');
    Route::get('/hapus-buku/{id}', [StaffController::class, 'hapusBuku'])->name('hapusBuku');

    Route::get('/konfirmasi', [StaffController::class, 'konfirmasi'])->name('konfirmasi');
    Route::get('/konfirmasi-pembelian/{id}', [StaffController::class, 'konfirmasiPembelian'])->name('konfirmasiPembelian');

});

Route::group(['middleware' => 'anggota.session'],function () {
    Route::get('/katalog', [AnggotaController::class, 'katalog'])->name('katalog');
    Route::post('/sewa-buku', [AnggotaController::class, 'sewaBuku'])->name('sewaBuku');
    Route::get('/history', [AnggotaController::class, 'history'])->name('history');

});
