<?php

namespace Controller;

use Model\Library_card;
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
        if ($request->method === 'POST'){
            $user = User::create([
                'login'=>random_int(1000, 10000),
                'role_id'=>$request->role_id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'patronymic'=>$request->patronymic,
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
            ]);

            $card = Library_card::create([
                'number'=> $user->login,
                'valid'=>date('Y-m-d'),
            ]);

            if ($user->role_id === '1' or $user->role_id === '3'){
                $card->staff = 1;
                $card->save();
            }
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

    public function book_add(): string
    {
        return new View('site.book_add');
    }


}

