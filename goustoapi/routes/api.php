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
 

Route::get('recipes', 'RecipeController@index');
Route::get('recipes/import', 'RecipeController@import');
Route::get('recipes/cuisines', 'RecipeController@listCuisines');
Route::get('recipes/{id}', 'RecipeController@show');
Route::get('recipes/cuisines/{name}', 'RecipeController@findCuisines');
Route::put('recipes/{id}', 'RecipeController@update');
Route::post('recipes', 'RecipeController@store');

Route::get('reciperatings/{recipeid}', 'RecipeRatingController@show');
Route::post('reciperatings', 'RecipeRatingController@store');
