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
Route::get('/privacy', 'PublicPageController@privacy')->name('privacy');
Auth::routes(['verify' => true]);
Route::get('/view/{id}', 'ViewController@index')->name('view');
Route::get('/upload', 'UploadController@index')->middleware('verified')->name('upload');
Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/report', 'HomeController@index')->middleware('verified')->name('report');
Route::get('/banner', 'bannerController@index')->middleware('verified')->name('banner');
Route::get('/users', 'UserController@index')->middleware('verified')->name('users');
Route::get('/create-user', 'UserController@create')->middleware('verified')->name('create-user');
Route::delete('/delete-user/{id}', 'UserController@delete')->middleware('verified')->name('delete-user');
Route::patch('/update-user', 'UserController@update')->middleware('verified')->name('update-user');
Route::post('/create-users', 'UserController@createUsers')->middleware('verified')->name('create-users');
Route::get('/contents', 'bookController@index')->middleware('verified')->name('contents');
Route::get('/recommend/{id}', 'bookController@recommend')->middleware('verified')->name('recommend');
Route::get('/un_recommend/{id}', 'bookController@un_recommend')->middleware('verified')->name('un_recommend');
Route::get('/explore', 'ExploreController@index')->name('explore');
Route::get('/org/{id}', 'ExploreController@org')->name('org');
Route::get('/books', 'bookController@index')->middleware('verified')->name('books');
Route::get('/subjects', 'bookController@subjects')->middleware('verified')->name('subjects');
Route::get('/subject/{id}', 'bookController@topics')->middleware('verified')->name('subject');
Route::get('/topic/{id}', 'bookController@topic')->middleware('verified')->name('topic');
Route::get('/topics', 'UploadController@getTopics')->middleware('verified')->name('topics');
Route::get('/create-topic/{id}', 'bookController@create_topic')->middleware('verified')->name('create-topic');
Route::get('/edit-topic/{id}', 'bookController@edit_topic')->middleware('verified')->name('edit-topic');
Route::post('/topic_store', 'bookController@store_topic')->middleware('verified')->name('store-topic');
Route::patch('/topic_update', 'bookController@update_topic')->middleware('verified')->name('update-topic');
Route::get('/topic_search', 'bookController@search_topic')->middleware('verified')->name('search-topic');
Route::delete('/delete-topic/{id}', 'bookController@delete_topic')->middleware('verified')->name('delete-topic');
Route::get('/profile', 'UserController@profile')->middleware('verified')->name('profile');
Route::get('/search', 'bookController@search')->middleware('verified')->name('search');
Route::get('/delete/{id}', 'bookController@delete')->middleware('verified')->name('delete');

Route::prefix('login')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider.callback');
});

// Post request
Route::post('/upload', 'UploadController@upload')->middleware('verified')->name('handleUpload');
Route::post('/banner', 'bannerController@upload')->middleware('verified')->name('upload_banner');
Route::post('/user/{id}', 'UserController@update')->middleware('verified')->name('update_profile');
