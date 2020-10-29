<?php

use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PescadoController;
use App\Http\Controllers\PescariaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){

    Route::get('profile/{user}', [UserController::class, 'show'])->name('profile');
    Route::post('profile/{user}/friends', FriendshipController::class)->name('friends');

    Route::get('search/', [UserController::class, 'search'])->name('search');

    Route::get('pescarias/', [PescariaController::class, 'index'])->name('pescaria.index');
    Route::post('pescarias/', [PescariaController::class, 'store'])->name('pescaria.store');
    Route::get('pescarias/create', [PescariaController::class, 'create'])->name('pescaria.create');
    Route::get('pescarias/{pescaria}', [PescariaController::class, 'show'])->name('pescaria.show');
    Route::post('pescarias/{pescaria}/finalizar', [PescariaController::class, 'finish'])->name('pescaria.finish');
    Route::get('pescarias/{pescaria}/podium', [PescariaController::class, 'podium'])->name('pescaria.podium');
    Route::get('pescarias/{pescaria}/edit', [PescariaController::class, 'edit'])->name('pescaria.edit');
    Route::put('pescarias/{pescaria}', [PescariaController::class, 'update'])->name('pescaria.update');
    // Route::delete('')

    /*Route::get('pescarias/{pescaria}/pescados', [PescadoController::class, 'indexByUser'])->name('pescado.index.user');
    Route::get('pescarias/{pescaria}/pescados', [PescadoController::class, 'indexByPescaria'])->name('pescado.index.pescaria');*/
    Route::get('pescarias/{pescaria}/pescados', [PescadoController::class, 'index'])->name('pescado.index');
    Route::post('pescarias/{pescaria}/pescados', [PescadoController::class, 'store'])->name('pescado.store');
    Route::get('pescarias/{pescaria}/pescados/create', [PescadoController::class, 'create'])->name('pescado.create');
    Route::get('pescarias/{pescaria}/pescados/{pescado}', [PescadoController::class, 'show'])->name('pescado.show');
    Route::get('pescarias/{pescaria}/pescados/{pescado}/edit', [PescadoController::class, 'edit'])->name('pescado.edit');
    Route::put('pescarias/{pescaria}/pescados/{pescado}', [PescadoController::class, 'update'])->name('pescado.update');
    // Route::delete('')
});
