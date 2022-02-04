<?php

use Src\Route;

Route::add('GET', '/popular', [Controller\Site::class, 'popular'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/book_register', [Controller\Site::class, 'book_register']);
Route::add(['GET', 'POST'], '/books', [Controller\Site::class, 'books']);
Route::add('GET', '/reader_card', [Controller\Site::class, 'reader_card']);
Route::add('GET', '/readers_list', [Controller\Site::class, 'readers_list']);
Route::add('GET', '/books_list', [Controller\Site::class, 'books_list']);
Route::add('GET', '/book', [Controller\Site::class, 'book']);