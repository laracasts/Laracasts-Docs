<?php

if (! defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', '1.0');
}

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

Route::get('docs/{version}/{page?}', 'DocumentationController@show');
