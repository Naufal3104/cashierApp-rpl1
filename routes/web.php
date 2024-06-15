<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
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
    
route::middleware('auth')->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/transaction', TransactionController::class);

    Route::post('/transaction/checkout', [TransactionController::class, 'checkout'])
        ->name('transaction.checkout');

    Route::get('history', [TransaksiController::class, 'history']);
    Route::resource('item',ItemController::class);
    Route::resource('transaksi',TransaksiController::class);
    Route::resource('category',CategoryController::class);
});
