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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/view/{id}', 'ViewController@index')->name('view');

Auth::routes(['verify' => true]);
Route::get('/upload', 'UploadController@index')->middleware('verified')->name('upload');
Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/report', 'HomeController@index')->middleware('verified')->name('report');
Route::get('/banner', 'bannerController@index')->middleware('verified')->name('banner');
Route::get('/users', 'UserController@index')->middleware('verified')->name('users');
Route::get('/book', 'bookController@index')->middleware('verified')->name('book');
Route::get('/shelf/{id}', 'ShelfController@index')->name('shelf');
Route::get('/books', 'bookController@index')->middleware('verified')->name('books');
Route::get('/profile', 'bookController@index')->middleware('verified')->name('profile');
Route::get('/search', 'bookController@search')->middleware('verified')->name('search');

Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});

// Post request
Route::post('/upload', 'UploadController@upload')->middleware('verified')->name('handleUpload');

