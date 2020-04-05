<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    // Route::get('/books', function () {
    //     $book = DB::table('all_book_data')->orderBy('id', 'DESC')->paginate(20);
    //     return response()->json(compact('book'));
    // });
    // Route::get('/search-book', function (Request $request) {
    //     $book = DB::table('all_book_data')->where('title','LIKE', '%'.$request->q.'%')->orWhere('description','LIKE', '%'.$request->q.'%')->orderBy('id', 'DESC')->get();
    //     return response()->json(compact('book'));
    // });
    // Route::prefix('remove')->group(function () {
    //     //Delete book from database.
    //     Route::get('/book', function (Request $request) {
    //         $directory = env('API_FILE_DIR') . '/book/' . $request->id;
    //         DB::table('book')->where('id', '=', $request->id)->delete();
    //         Storage::deleteDirectory($directory);
    //         return 'success';
    //     });
    // });
// });