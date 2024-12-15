<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログイン必須のルーティング
Route::middleware('auth')->group(function () {

    // 商品
    Route::prefix('items')->group(function () {
        Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::get('/edit/{edit_id}', [App\Http\Controllers\ItemController::class, 'edit']);
        Route::put('/update/{update_id}', [App\Http\Controllers\ItemController::class, 'update']);
        Route::delete('/delete/{delete_id}', [App\Http\Controllers\ItemController::class, 'destroy']);
    });

    // 種別
    Route::prefix('types')->group(function () {
        Route::get('/', [App\Http\Controllers\TypeController::class, 'index']);
        Route::get('/add', [App\Http\Controllers\TypeController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\TypeController::class, 'add']);
        Route::get('/edit/{edit_id}', [App\Http\Controllers\TypeController::class, 'edit']);
        Route::put('/update/{update_id}', [App\Http\Controllers\TypeController::class, 'update']);
        Route::delete('/delete/{delete_id}', [App\Http\Controllers\TypeController::class, 'destroy']);
    }); 
});