<?php

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
    return redirect()->route('vendor-doc.index');
})->middleware('auth');

Route::resource('vendor-doc', 'VendorDocController')
    ->middleware('auth');

Route::get('/vendor-certificate/{id}', 'VendorCertificate')
    ->name('vendor-certificate')
    ->middleware('auth');

Auth::routes();
