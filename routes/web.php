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

Route::get('/be16f422-d3c8-11e9-bb65-2a2ae2dbcce4', function () {
    return view('pwa');
})->where('any', '.*');


Route::get('/', function () {
    return view('app');
});



Route::resources([
    'ingredients' => 'IngredientsController',
    'categories' => 'CategoriesController',
    'brands' => 'BrandsController'
]);
