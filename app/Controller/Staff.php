<?php

namespace Controller;

use Model\Library_card;
use Model\Role;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Staff
{

    public function user_add(Request $request): string
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

            if (User::find(1)->role()->where('role', 'Библиотекарь' or 'Администратор')){
                $card->staff = 1;
                $card->save();
            }
            app()->route->redirect('/popular');
        }
        $roles = Role::orderBy('id')->get();
        return (new View())->render('site.user_add', ['roles'=>$roles]);
    }

    public function book_register(): string
    {
        return new View('site.book_register');
    }

    public function book_add(): string
    {
        return new View('site.book_add');
    }

    public function readers_list(): string
    {
        return new View('site.readers_list');
    }

    public function books_list(): string
    {
        return new View('site.books_list');
    }


}