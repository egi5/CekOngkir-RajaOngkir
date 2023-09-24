<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CekOngkirController;
use App\Http\Controllers\PerulanganController;

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

//Menu Perulangan
Route::get('/', [PerulanganController::class, 'index']);
Route::post('/cekBilangan', [PerulanganController::class, 'cek']);

//Menu Cek Ongkir
Route::get('/cekOngkir', [CekOngkirController::class, 'index']);
Route::get('/cities/{province_id}', [CekOngkirController::class, 'getCities']);
Route::post('/ongkir', [CekOngkirController::class, 'checkOngkir']);

