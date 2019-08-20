<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/ingredients', 'IngredientsController@index');
Route::post('/ingredients', 'IngredientsController@store');
Route::get('/ingredients/{ingredient}/edit', 'IngredientsController@edit');
Route::put('/ingredients/{ingredient}', 'IngredientsController@update');

Route::get('/categories', 'CategoriesController@index');
Route::post('/categories', 'CategoriesController@store');
Route::get('/categories/{category}/edit', 'CategoriesController@edit');
Route::put('/categories/{category}', 'CategoriesController@update');

Route::get('/brands', 'BrandsController@index');
Route::post('/brands', 'BrandsController@store');
Route::get('/brands/{brand}/edit', 'BrandsController@edit');
Route::put('/brands/{brand}', 'BrandsController@update');


Route::post('/products', 'ProductsController@store');
Route::get('/products', 'ProductsController@index');

Route::post('/ingredients-collection', 'IngredientsCollectionController@store');
Route::get('/enums/{enum}', 'EnumsController@show');

Route::get('/search/{search}', 'SearchController@show');
