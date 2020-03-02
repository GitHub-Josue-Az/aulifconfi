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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Teachers
Route::group(['prefix' => 'store', 'as' => 'store.', 'middleware' => []], function () {
    // Recursos
    Route::resource('lessons', 'Api\LessonsController');
    Route::resource('courses', 'Api\CoursesController');
    Route::get('courses/{id}/image', 'Api\CoursesController@image')->name('courses.image');
    Route::resource('books', 'Api\BooksController');
    Route::get('books/{id}/image', 'Api\BooksController@image')->name('books.image');
});

// Teachers
Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => []], function () {
    // Recursos
    Route::resource('lessons', 'Api\LessonsController');
    Route::resource('courses', 'Api\CoursesController');
    Route::get('courses/{id}/image', 'Api\CoursesController@image')->name('courses.image');
    Route::resource('books', 'Api\BooksController');
    Route::get('books/{id}/image', 'Api\BooksController@image')->name('books.image');
});

// Students
Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => []], function () {
    // Recursos
    Route::resource('lessons', 'Api\LessonsController');
    Route::resource('courses', 'Api\CoursesController');
    Route::get('courses/{id}/image', 'Api\CoursesController@image')->name('courses.image');
    Route::resource('books', 'Api\BooksController');
    Route::get('books/{id}/image', 'Api\BooksController@image')->name('books.image');
});