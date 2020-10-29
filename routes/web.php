<?php

use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\HomeController;
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
    Route::get('pescarias/{pescaria}/edit', [PescariaController::class, 'edit'])->name('pescaria.edit');
    Route::put('pescarias/{pescaria}', [PescariaController::class, 'update'])->name('pescaria.update');
    // Route::delete('')
});
