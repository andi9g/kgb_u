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


Route::get('login', 'aksesC@login');
Route::post('login', 'aksesC@proses')->name('proses.login');
Route::get('logout', 'aksesC@logout');

Route::middleware(['GerbangLogin'])->group(function () {
    Route::get('home', 'indexC@index');
    
    Route::resource('/pegawai', 'pegawaiC');
    
    Route::get('kgb', 'kgbC@index');
    Route::PUT('kgb/proses/{nik}/{tanggalkgb}', 'kgbC@proses')->name('proses.kgb');
    Route::post('kgb/normalkan/{nik}', 'kgbC@normalkan')->name('normalkan.kgb');
    
    Route::get('laporan/kgb', 'laporanC@keseluruhan')->name('cetak.kgb.keseluruhan');
    Route::get('laporan/kgb/{nik}', 'laporanC@satuan')->name('cetak.kgb.satuan');
    
    Route::resource('pengaturan', 'pengaturanC');
    Route::resource('admin', 'adminC');    
});

