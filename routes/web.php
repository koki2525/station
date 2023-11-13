<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WholesalerTrucksController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PagesController;

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
    return view('welcome');
});

Auth::routes();

// Order Form
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Pages
Route::get('/home', [PagesController::class, 'index'])->name('home');
Route::get('/pages/wholesaler-trucks', [PagesController::class, 'trucks'])->name('pages.trucks');
Route::get('/pages/stock-levels', [PagesController::class, 'stock'])->name('pages.stocks');
Route::get('/pages/station-details', [PagesController::class, 'stationDetails'])->name('pages.details');
