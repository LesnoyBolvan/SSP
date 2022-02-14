<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Model\BookAuthor;
use Model\RentedBook;
use Model\Role;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{

    public function popular(Request $request): string
    {
        $count = BookAuthor::orderBy('count', 'DESC')->take(20)->get('book_id');
        $popular = Book::whereIn('id', $count)->get();
        return (new View())->render('site.popular', ['popular' => $popular]);
    }

    public function books(Request $request): string
    {
        if($request->method==='POST'){
            $search = $request->search;
            $author = Author::where('first_name', $search)->orWhere('last_name');
            $book = Book::where('title', $search)->get();
            return new View('site.books', ['books' => $book]);
        }
        $books = Book::all();
        return new View('site.books', ['books' => $books]);

    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/popular');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return (new View())->render('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/popular');
    }

}

