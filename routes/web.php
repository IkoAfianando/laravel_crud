<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RumahController;
use App\Http\Controllers\PemasukanController;

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

Route::get('/', function () {
    return view('layouts.app2');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware(['auth']);
});

Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/employee', [EmployeeController::class, 'index'])->middleware(['auth']);
    Route::post('/store', [EmployeeController::class, 'store'])->name('store')->middleware(['auth']);
    Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll')->middleware(['auth']);
    Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete')->middleware(['auth']);
    Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit')->middleware(['auth']);
    Route::post('/update', [EmployeeController::class, 'update'])->name('update')->middleware(['auth']);
});

Route::group(['middleware', ['role:admin|user']], function () {
    Route::get('/warga', [WargaController::class, 'index'])->middleware(['auth']);
    Route::post('/warga.store', [WargaController::class, 'warga_store'])->name('warga.store')->middleware(['auth']);
    Route::post('/warga.update', [WargaController::class, 'warga_update'])->name('warga.update')->middleware(['auth']);
    Route::get('/warga.fetchall', [WargaController::class, 'warga_fetchAll'])->name('warga.fetchAll')->middleware(['auth']);
    Route::delete('/warga.delete', [WargaController::class, 'warga_delete'])->name('warga.delete')->middleware(['auth']);
    Route::get('/warga.edit', [WargaController::class, 'warga_edit'])->name('warga.edit')->middleware(['auth']);
});

Route::group(['middleware', ['role:admin|user']], function () {
    Route::get('/rumah', [RumahController::class, 'index'])->middleware(['auth']);
    Route::post('/rumah.store', [RumahController::class, 'rumah_store'])->name('rumah.store')->middleware(['auth']);
    Route::post('/rumah.update', [RumahController::class, 'rumah_update'])->name('rumah.update')->middleware(['auth']);
    Route::get('/rumah.fetchall', [RumahController::class, 'rumah_fetchAll'])->name('rumah.fetchAll')->middleware(['auth']);
    Route::delete('/rumah.delete', [RumahController::class, 'rumah_delete'])->name('rumah.delete')->middleware(['auth']);
    Route::get('/rumah.edit', [RumahController::class, 'rumah_edit'])->name('rumah.edit')->middleware(['auth']);
});

Route::group(['middleware', ['role:admin|user']], function () {
    Route::get('/pemasukan', [PemasukanController::class, 'index'])->middleware(['auth']);
    Route::post('/pemasukan.store', [PemasukanController::class, 'pemasukan_store'])->name('pemasukan.store')->middleware(['auth']);
    Route::post('/pemasukan.update', [PemasukanController::class, 'pemasukan_update'])->name('pemasukan.update')->middleware(['auth']);
    Route::get('/pemasukan.fetchall', [PemasukanController::class, 'pemasukan_fetchAll'])->name('pemasukan.fetchAll')->middleware(['auth']);
    Route::delete('/pemasukan.delete', [PemasukanController::class, 'pemasukan_delete'])->name('pemasukan.delete')->middleware(['auth']);
    Route::get('/pemasukan.edit', [PemasukanController::class, 'pemasukan_edit'])->name('pemasukan.edit')->middleware(['auth']);
});



require __DIR__ . '/auth.php';
