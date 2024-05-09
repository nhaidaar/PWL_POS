<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\Api\LevelController;
Route::get('levels', [LevelController::class, 'index']);
Route::post('levels', [LevelController::class, 'store']);
Route::get('levels/{level}', [LevelController::class, 'show']);
Route::put('levels/{level}', [LevelController::class, 'update']);
Route::delete('levels/{level}', [LevelController::class, 'destroy']);

use App\Http\Controllers\Api\KategoriController;
Route::get('categories', [KategoriController::class, 'index']);
Route::post('categories', [KategoriController::class, 'store']);
Route::get('categories/{kategori}', [KategoriController::class, 'show']);
Route::put('categories/{kategori}', [KategoriController::class, 'update']);
Route::delete('categories/{kategori}', [KategoriController::class, 'destroy']);

use App\Http\Controllers\Api\BarangController;
Route::get('stuffs', [BarangController::class, 'index']);
Route::post('stuffs', [BarangController::class, 'store']);
Route::get('stuffs/{barang}', [BarangController::class, 'show']);
Route::put('stuffs/{barang}', [BarangController::class, 'update']);
Route::delete('stuffs/{barang}', [BarangController::class, 'destroy']);

Route::post('/register1', App\Http\Controllers\Api\RegisterController::class)->name('register1');
Route::post('/barang1', App\Http\Controllers\Api\BarangController::class)->name('barang1');