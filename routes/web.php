<?php

use Src\Route;

Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/popular', [Controller\Site::class, 'popular'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/user_add', [Controller\Staff::class, 'user_add'])
    ->middleware('staff');
Route::add(['GET', 'POST'], '/book_register', [Controller\Staff::class, 'book_register'])
    ->middleware('admin', 'librarian');
Route::add('GET', '/readers_list', [Controller\Staff::class, 'readers_list'])
    ->middleware('admin', 'librarian');
Route::add('GET', '/books_list', [Controller\Staff::class, 'books_list'])
    ->middleware('admin', 'librarian');
Route::add('GET', '/book_add', [Controller\Staff::class, 'book_add'])
    ->middleware('admin', 'librarian');
Route::add('GET', '/book', [Controller\Reader::class, 'book'])
    ->middleware('auth');
Route::add('GET', '/reader_card', [Controller\Reader::class, 'reader_card'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/books', [Controller\Reader::class, 'books'])
    ->middleware('auth');