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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('refresh-token', 'AuthController@refreshToken');
//Route::post('logout', 'AuthController@logout');

Route::get('image/{image}', 'ImageController@show');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('me', 'AuthController@details'); // user profile
    Route::get('categories', 'CategoriesController@index')->name('categories.index');
    Route::get('books', 'BooksController@index')->name('books.index');
    Route::post('books/publish', 'BooksController@store')->name('books.publish');//->middleware('checkAccess');
});
