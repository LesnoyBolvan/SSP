<?php

use Src\Route;

Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/popular', [Controller\Site::class, 'popular'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/user_add', [Controller\Staff::class, 'userAdd'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/book_register', [Controller\Staff::class, 'bookRegister'])
    ->middleware('staff');
Route::add('GET', '/readers_list', [Controller\Staff::class, 'readersList'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/books_list', [Controller\Staff::class, 'booksList'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/book_add', [Controller\Staff::class, 'bookAdd'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/book_delete', [Controller\Staff::class, 'bookDelete'])
    ->middleware('staff');
//Route::add('GET', '/search_books', [Controller\Staff::class, 'searchBooksList'])
//    ->middleware('staff');
Route::add(['GET', 'POST'], '/author_add', [Controller\Staff::class, 'authorAdd'])
    ->middleware('staff');
Route::add('GET', '/authors_list', [Controller\Staff::class, 'authorsList'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/author_delete', [Controller\Staff::class, 'authorDelete'])
    ->middleware('staff');
Route::add('GET', '/reader_card', [Controller\Reader::class, 'readerCard'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/books', [Controller\Site::class, 'books'])
    ->middleware('auth');