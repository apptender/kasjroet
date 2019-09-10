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
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

Route::get('/{uuid}', function () {
    return view('pwa');
})->where('any', '.*');


Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');



Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');


Route::resources([
    'ingredients' => 'IngredientsController',
    'categories' => 'CategoriesController',
    'brands' => 'BrandsController'
]);
