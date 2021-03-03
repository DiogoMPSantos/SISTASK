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

Route::group(['prefix' => 'tarefas'], function () {
    Route::get('home', 'App\Http\Controllers\TarefaController@index');
    Route::post('create', 'App\Http\Controllers\TarefaController@store');
    Route::get('edit/{id}', 'App\Http\Controllers\TarefaController@edit');
    Route::post('update/{id}', 'App\Http\Controllers\TarefaController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\TarefaController@destroy');
    Route::get('categorias', 'App\Http\Controllers\CategoriaController@index');
    Route::post('createCategoria', 'App\Http\Controllers\CategoriaController@store');
    Route::delete('deleteCategoria/{id}', 'App\Http\Controllers\CategoriaController@destroy');
    Route::get('editCategoria/{id}', 'App\Http\Controllers\CategoriaController@edit');
    Route::post('updateCategoria/{id}', 'App\Http\Controllers\CategoriaController@update');
    
});