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

Route::get('/', function () {
    return view('home');
});

Route::get('/Authors','AuthorController@ShowAllAuthors')->name('ShowAuthors');
Route::get('/authors','AuthorController@GetSortNameAuthors')->name('ShowSortAuthors');
Route::get('/Books','BookController@ShowAllBooks')->name('ShowBooks');
Route::get('/books','BookController@GetSortNameBooks')->name('ShowSortBooks');
Route::get('/SearchBook', 'BookController@Search')->name('SearchBooks');
Route::get('/SearchAuthor', 'AuthorController@Search')->name('SearchAuthors');
Route::delete('/autor/delete/{id}', 'AuthorController@Delete')->name('AuthorDelete');
Route::delete('/book/delete/{id}', 'BookController@Delete')->name('BookDelete');
Route::post('/author/add', 'AuthorController@Add')->name('AddAuthor');
Route::post('/author/update', 'AuthorController@Update')->name('UpdateAuthor');
Route::post('/book/update', 'BookController@Update')->name('UpdateBook');
Route::post('/book/add', 'BookController@Add')->name('AddBook');
Route::post('/book/img', 'BookController@AddImg')->name('AddImg');


