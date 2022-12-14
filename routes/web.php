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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::resource('/','App\Http\Controllers\TaskController');
Route::post('/', 'App\Http\Controllers\TaskController@store')->name('crear');
Route::delete('/${id}', 'App\Http\Controllers\TaskController@destroy')->name('borrar');
Route::put('/${id}', 'App\Http\Controllers\TaskController@update')->name('cambiarEstado');