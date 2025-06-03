<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\BarangApiController;
use App\Http\Controllers\Api\PeminjamanApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/login', [PenggunaController::class, 'login']);

Route::get('/barang', [BarangApiController::class, 'index']);

Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);

Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
Route::get('/barang', [BarangApiController::class, 'index']); // ini untuk fetch dropdown


