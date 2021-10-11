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
    return view('welcome');
});

//Rota de Categorias
Route::get('/categorias',             'CategoryController@index');

Route::get('/categorias/criar',       'CategoryController@create');
Route::post('/categorias',            'CategoryController@insert');

Route::get('/categorias/{id}/editar', 'CategoryController@edit');
Route::put('/categorias',             'CategoryController@update');

Route::delete('/categorias',          'CategoryController@delete');

//Rota de Produtos
Route::get('/produtos',             'ProductController@index');

Route::get('/produtos/criar',       'ProductController@create');
Route::post('/produtos',            'ProductController@insert');

Route::get('/produtos/{id}/editar', 'ProductController@edit');
Route::put('/produtos',             'ProductController@update');

Route::delete('/produtos',          'ProductController@delete');
