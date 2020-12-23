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

// ********** authentification ***********

Auth::routes();


// ********** accueil ***********

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ********** User ***********

Route::get('account/{user}', [App\Http\Controllers\UserController::class, 'account'])->name('account');
Route::put('account/update',  [App\Http\Controllers\UserController::class, 'update'])->name('account.update');
Route::put('account/updatePassword',  [App\Http\Controllers\UserController::class, 'updatePassword'])->name('account.updatePassword');
Route::delete('user/delete',  [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');


// ********** adresse ***********

Route::post('address/create',  [App\Http\Controllers\AdresseController::class, 'create'])->name('address.create');
Route::put('address/update/{address}',  [App\Http\Controllers\AdresseController::class, 'update'])->name('address.update');
Route::delete('address/delete/{address}',  [App\Http\Controllers\AdresseController::class, 'delete'])->name('address.delete');


// ********** Articles ***********

Route::resource('articles', App\Http\Controllers\ArticleController::class);


// ********** Gammes ***********

Route::resource('gammes', App\Http\Controllers\GammeController::class);


// ********** Campagnes ***********

Route::resource('campagnes', App\Http\Controllers\CampagneController::class);


// ********** Panier **********

Route::get('basket', [App\Http\Controllers\BasketController::class, 'show'])->name('basket.show');
Route::post('basket/add/{product}', [App\Http\Controllers\BasketController::class, 'add'])->name('basket.add');
Route::get('basket/remove/{product}', [App\Http\Controllers\BasketController::class, 'remove'])->name('basket.remove');
Route::get('basket/empty', [App\Http\Controllers\BasketController::class, 'empty'])->name('basket.empty');
Route::get('basket/emptyAfterOrder', [App\Http\Controllers\BasketController::class, 'emptyAfterOrder'])->name('basket.emptyAfterOrder');
Route::get('basket/validation', [App\Http\Controllers\BasketController::class, 'validation'])->name('basket.validation');
Route::post('basket/validation', [App\Http\Controllers\BasketController::class, 'validation'])->name('basket.validation');
Route::post('basket/choosedelivery', [App\Http\Controllers\BasketController::class, 'chooseDelivery'])->name('basket.choosedelivery');


// ********** Commandes **********

Route::resource('commandes', App\Http\Controllers\CommandeController::class);


// ********** Notre histoire / qualité **********

Route::get('apropos', [App\Http\Controllers\HomeController::class, 'apropos'])->name('apropos');


// ********** Admin **********

Route::get('admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


// ********** Favoris **********

Route::resource('favoris', App\Http\Controllers\FavoriController::class);


// ********** Avis **********

Route::resource('avis', App\Http\Controllers\AvisController::class);