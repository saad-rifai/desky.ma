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

Route::get('/', function () {
    return view('accueil');
});
Route::get('/chercheurs-de-marché', function () {
    return view('chercheurs-de-marché');
});
Route::get('/qui-sommes-nous', function () {
    return view('qui-sommes-nous');
});
Route::get('/les-appel-doffre', function () {
    return view('les-appel-doffre');
});
Route::get('/appel-offre/{id}', function ($id) {
    return view('appel-offre');
});
Route::get('/profile/{id}', function ($id) {
    return view('page-de-societe');
});