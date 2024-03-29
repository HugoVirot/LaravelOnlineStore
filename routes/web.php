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

Route::get('test', [App\Http\Controllers\UserController::class, 'test'])->name('test');

// ********** accueil ***********

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ********** User ***********

Route::get('account/{user}', [UserController::class, 'account'])->name('account');
Route::put('account/update',  [App\Http\Controllers\UserController::class, 'update'])->name('account.update');
Route::put('account/updatePassword',  [App\Http\Controllers\UserController::class, 'updatePassword'])->name('account.updatePassword');
Route::delete('user/delete',  [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');


// ********** Adresse ***********

Route::post('address/store',  [App\Http\Controllers\AdresseController::class, 'store'])->name('address.store');
Route::put('address/update',  [App\Http\Controllers\AdresseController::class, 'update'])->name('address.update');
Route::delete('address/delete',  [App\Http\Controllers\AdresseController::class, 'delete'])->name('address.delete');


// ********** Articles ***********

Route::resource('articles', App\Http\Controllers\ArticleController::class)->except('create');


// ********** Gammes ***********

Route::resource('gammes', App\Http\Controllers\GammeController::class)->except('create');


// ********** Campagnes ***********

Route::resource('campagnes', App\Http\Controllers\CampagneController::class)->except('create');


// ********** Panier **********

Route::get('cart', [App\Http\Controllers\CartController::class, 'show'])->name('cart.show');
Route::post('cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{product}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/empty', [App\Http\Controllers\CartController::class, 'empty'])->name('cart.empty');
Route::get('cart/emptyAfterOrder', [App\Http\Controllers\CartController::class, 'emptyAfterOrder'])->name('cart.emptyAfterOrder');

// afficher la page validation (lien du bouton validation dans le panier) => méthode GET
Route::get('cart/validation', [App\Http\Controllers\CartController::class, 'validation'])->name('cart.validation');

// valider choix d'adresse de livraison ou de facturation
Route::post('cart/validation', [App\Http\Controllers\CartController::class, 'validation'])->name('cart.validation');

Route::post('cart/choosedelivery', [App\Http\Controllers\CartController::class, 'chooseDelivery'])->name('cart.choosedelivery');


// ********** Commandes **********

Route::resource('commandes', App\Http\Controllers\CommandeController::class);
Route::post('commandes', [App\Http\Controllers\CommandeController::class, 'store'])->name('commandes.store');
Route::get('commandes/{commande}', [App\Http\Controllers\CommandeController::class, 'show'])->name('commandes.show');


// ********** Notre histoire / qualité **********

Route::get('apropos', [App\Http\Controllers\HomeController::class, 'apropos'])->name('apropos');


// ********** Admin **********

Route::get('admin/index', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


// ********** Favoris **********

Route::resource('favoris', App\Http\Controllers\FavoriController::class)->only('index' , 'store', 'destroy');


// ********** Avis **********

Route::post('avis', [App\Http\Controllers\AvisController::class, 'store'])->name('avis.store');


// ********** Politique de confidentialité **********

Route::get('politique', [App\Http\Controllers\HomeController::class, 'politique'])->name('politique');


//Route::get('/mail', [App\Http\Controllers\TestController::class, 'mail'])->name('mail');
