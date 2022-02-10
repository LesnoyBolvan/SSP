<?php

namespace Controller;

use Model\Role;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{

    public function popular(Request $request): string
    {
//        $popular = Post::where('id', $request->id)->get();
//        return (new View())->render('site.post', ['popular' => $popular]);
        return (new View())->render('site.popular');
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

