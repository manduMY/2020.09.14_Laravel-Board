<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('contentList', 'ContentController@index');
Route::post('create', 'ContentController@create');
Route::get('findContent/{id}', 'ContentController@findContent');
Route::put('update/{id}', 'ContentController@update');
Route::delete('delete/{id}', 'ContentController@delete');