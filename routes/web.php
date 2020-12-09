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

// ********** accueil ***********

Route::get('/', function () {
    return view('home');
});


// ********** authentification ***********

Auth::routes();


// ********** accueil ***********

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ********** user ***********

Route::get('account/{user}', [App\Http\Controllers\UserController::class, 'account'])->name('account');
Route::put('account/update',  [App\Http\Controllers\UserController::class, 'update'])->name('account.update');
Route::put('account/updatePassword',  [App\Http\Controllers\UserController::class, 'updatePassword'])->name('account.updatePassword');


// ********** adresse ***********

Route::post('address/create',  [App\Http\Controllers\AdresseController::class, 'create'])->name('address.create');
Route::put('address/update',  [App\Http\Controllers\AdresseController::class, 'update'])->name('address.update');

// ********** Articles ***********

Route::resource('articles/', App\Http\Controllers\ArticleController::class);

