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


Route::post('/contact', 'ContactController@store')->name('contact.store');

Route::post('/login', 'UserController@login')->name('user.login');

Route::get('/user', 'UserController@user')->name('user.me')
    ->middleware('jwt.auth');

Route::resource('users', 'UserController');

Route::resource('articles', 'ArticleController');
Route::resource('projects', 'ProjectController');
Route::resource('technologies', 'TechnologyController');

