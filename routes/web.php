<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('account/{user}',[UserController::class, 'account'])->name('account');
Route::put('account/update',  [App\Http\Controllers\UserController::class, 'update'])->name('account.update');
Route::put('account/updatePassword',  [App\Http\Controllers\UserController::class, 'updatePassword'])->name('account.updatePassword');
Route::delete('user/delete',  [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');


// ********** adresse ***********

Route::post('address/create',  [App\Http\Controllers\AdresseController::class, 'create'])->name('address.create');
Route::put('address/update',  [App\Http\Controllers\AdresseController::class, 'update'])->name('address.update');
Route::delete('address/delete',  [App\Http\Controllers\AdresseController::class, 'delete'])->name('address.delete');


// ********** Articles ***********

Route::resource('articles', App\Http\Controllers\ArticleController::class);


// ********** Gammes ***********

Route::resource('gammes', App\Http\Controllers\GammeController::class);


// ********** Campagnes ***********

Route::resource('campagnes', App\Http\Controllers\CampagneController::class);


// ********** Panier **********

Route::get('cart', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
Route::post('cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{product}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/empty', [App\Http\Controllers\CartController::class, 'empty'])->name('cart.empty');
Route::get('cart/emptyAfterOrder', [App\Http\Controllers\CartController::class, 'emptyAfterOrder'])->name('cart.emptyAfterOrder');
Route::get('cart/validation', [App\Http\Controllers\CartController::class, 'validation'])->name('cart.validation');
Route::post('cart/validation', [App\Http\Controllers\CartController::class, 'validation'])->name('cart.validation');
Route::post('cart/choosedelivery', [App\Http\Controllers\CartController::class, 'chooseDelivery'])->name('cart.choosedelivery');


// ********** Commandes **********

Route::resource('commandes', App\Http\Controllers\CommandeController::class);
Route::post('commandes', [ App\Http\Controllers\CommandeController::class, 'store'])->name('commandes.store');
Route::get('commandes/{commande}', [ App\Http\Controllers\CommandeController::class, 'show'])->name('commandes.show');


// ********** Notre histoire / qualité **********

Route::get('apropos', [App\Http\Controllers\HomeController::class, 'apropos'])->name('apropos');


// ********** Admin **********

Route::get('admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


// ********** Favoris **********

Route::get('favoris', [App\Http\Controllers\FavoriController::class, 'index'])->name('favoris.index');
Route::post('favoris', [App\Http\Controllers\FavoriController::class, 'store'])->name('favoris.store');
Route::delete('favoris', [App\Http\Controllers\FavoriController::class, 'destroy'])->name('favoris.destroy');


// ********** Avis **********

Route::post('avis', [ App\Http\Controllers\AvisController::class, 'store'])->name('avis.store');




//Route::get('/mail', [App\Http\Controllers\TestController::class, 'mail'])->name('mail');

