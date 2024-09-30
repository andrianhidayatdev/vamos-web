<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware(['check.login']);

Route::prefix('kategori')->middleware(['check.login'])->group(function () {
  Route::get('/', [KategoriController::class, 'index'])->name('master.kategori.index');
  Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('master.kategori.delete');
  Route::post('/create', [KategoriController::class, 'create'])->name('master.kategori.create');
  Route::post('/update', [KategoriController::class, 'update'])->name('master.kategori.update');
});

Route::prefix('member')->middleware(['check.login'])->group(function () {
  Route::get('/', [MemberController::class, 'index'])->name('master.member.index');
  Route::delete('/delete/{id}', [MemberController::class, 'destroy'])->middleware(['check.admin.manager'])->name('master.member.delete');
  Route::post('/create', [MemberController::class, 'create'])->name('master.member.create');
  Route::post('/update', [MemberController::class, 'update'])->middleware(['check.admin.manager'])->name('master.member.update');
});

Route::prefix('supplier')->middleware(['check.login'])->group(function () {
  Route::get('/', [SupplierController::class, 'index'])->name('master.supplier.index');
  Route::delete('/delete/{id}', [SupplierController::class, 'destroy'])->name('master.supplier.delete');
  Route::post('/create', [SupplierController::class, 'create'])->name('master.supplier.create');
  Route::post('/update', [SupplierController::class, 'update'])->name('master.supplier.update');
});

Route::prefix('produk')->middleware(['check.login'])->group(function () {
  Route::get('/', [ProdukController::class, 'index'])->name('master.produk.index');
  Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->middleware(['check.admin.manager'])->name('master.produk.delete');
  Route::post('/create', [ProdukController::class, 'create'])->name('master.produk.create');
  Route::post('/update', [ProdukController::class, 'update'])->middleware(['check.admin.manager'])->name('master.produk.update');
});

Route::prefix('role')->middleware(['check.login', 'check.admin'])->group(function () {
  Route::get('/', [RoleController::class, 'index'])->name('system.role.index');
  Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('system.role.delete');
  Route::post('/create', [RoleController::class, 'create'])->name('system.role.create');
  Route::post('/update', [RoleController::class, 'update'])->name('system.role.update');
});

Route::prefix('user')->middleware(['check.login', 'check.admin.manager'])->group(function () {
  Route::get('/', [UserController::class, 'index'])->name('system.user.index');
  Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('system.user.delete');
  Route::post('/create', [UserController::class, 'create'])->name('system.user.create');
  Route::post('/update', [UserController::class, 'update'])->name('system.user.update');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware(['check.not.login']);
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post')->middleware(['check.not.login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('profile')->middleware(['check.login'])->group(function () {
  Route::get('/', [UserController::class, 'profile'])->name('profile');
  Route::post('/update', [UserController::class, 'updateProfile'])->name('update.profile');
});


Route::prefix('setting')->middleware(['check.login', 'check.admin.manager'])->group(function () {
  Route::get('/', [SettingController::class, 'index'])->name('system.setting');
  Route::post('/updateOrCreate', [SettingController::class, 'updateOrCreate'])->name('system.setting.updateOrCreate');
  Route::post('/createOrUpdateOtherSetting', [SettingController::class, 'createOrUpdateOtherSetting'])->name('system.setting.createOrUpdateOtherSetting');
});

Route::prefix('cabang')->middleware(['check.login', 'check.admin.manager'])->group(function () {
  Route::get('/', [CabangController::class, 'index'])->name('system.cabang.index');
  Route::delete('/delete/{id}', [CabangController::class, 'destroy'])->name('system.cabang.delete');
  Route::post('/create', [CabangController::class, 'create'])->name('system.cabang.create');
  Route::post('/update', [CabangController::class, 'update'])->name('system.cabang.update');
});


Route::prefix('pengeluaran')->middleware(['check.login'])->group(function () {
  Route::get('/', [PengeluaranController::class, 'index'])->name('transaksi.pengeluaran.index');
  Route::post('/create', [PengeluaranController::class, 'create'])->name('transaksi.pengeluaran.create');
});


Route::prefix('penjualan')->middleware(['check.login'])->group(function () {
  Route::get('/', [PenjualanController::class, 'index'])->name('transaksi.penjualan.index');
});

Route::prefix('laporan')->middleware(['check.login'])->group(function () {
  Route::get('/', [LaporanController::class, 'index'])->name('report.laporan.index');
  Route::get('/pdf/{tanggal_awal?}/{tanggal_akhir?}', [LaporanController::class, 'pdf'])->name('report.laporan.pdf');
});


Route::prefix('log')->middleware(['check.login', 'check.admin'])->group(function () {
  Route::get('/', [LogController::class, 'index'])->name('system.log.index');
});
