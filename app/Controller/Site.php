<?php

namespace Controller;

use Model\Post;
use Model\Role;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use Illuminate\Support\Facades\DB;

class Site
{

    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }


    public function popular(): string
    {
        return new View('site.popular', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && User::create($request->all())) {

            app()->route->redirect('/popular');
        }
        $roles = Role::orderBy('id')->get();
        return new View('site.signup', ['roles'=>$roles]);
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
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/popular');
    }

    public function book_register(): string
    {
        return new View('site.book_register');
    }

    public function books(): string
    {
        return new View('site.books');
    }

    public function reader_card(): string
    {
        return new View('site.reader_card');
    }

    public function readers_list(): string
    {
        return new View('site.readers_list');
    }

    public function books_list(): string
    {
        return new View('site.books_list');
    }

    public function book(): string
    {
        return new View('site.book');
    }



}

