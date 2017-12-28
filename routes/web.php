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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/api', function () {
    return view('api');
});

Route::any('/', function () {
    return view('home/index');
});

Route::any('home', 'Home\IndexController@home');
// Route::any('home', 'Home\IndexController@home')->middleware('checklog');

// Route::any('home', function () {
//     return view('home/home');
// })->middleware('checklog');

Route::any('index', 'Home\IndexController@index');

Route::any('register', 'Home\IndexController@register');
Route::any('registers', 'Home\IndexController@registers');

Route::any('homess', function () {
    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');
});