<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Model\LibraryCard;
use Model\Role;
use Model\User;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class Staff
{

    public function userAdd(Request $request): string
    {
        if ($request->method === 'POST'){

            $validator = new Validator($request->all(), [
                'first_name'=> ['required'],
                'last_name'=> ['required'],
                'phone_number'=> ['required', 'unique:users,phone_number'],
                'address'=> ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                $roles = Role::orderBy('id')->get();
                return new View('site.user_add',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            $user = User::create([
                'login'=>random_int(1000, 10000),
                'password'=> User::password(),
                'role_id'=>$request->role_id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'patronymic'=>$request->patronymic,
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,

            ]);

            $card = LibraryCard::create([
                'number'=> $user->login,
                'valid'=>date('Y-m-d'),
            ]);

            if ($user->role->code==='librarian' or $user->role->code==='admin'){
                $card->save();
                $card->staff = 1;
            }
            app()->route->redirect('/popular');
        }
        $roles = Role::orderBy('id')->get();
        return (new View())->render('site.user_add', ['roles'=>$roles]);
    }

    public function bookRegister(): string
    {
        return new View('site.book_register');
    }

    public function bookAdd(Request $request): string
    {
        if ($request->method==='POST' && Book::create($request->all())){
            return new View('site.book_add', ['message'=>'Книга добавлена']);
        }
        return new View('site.book_add');
    }

    public function authorAdd(Request $request): string
    {
        if ($request->method==='POST'){

            $validator = new Validator($request->all(), [
                'first_name'=> ['required'],
                'last_name'=> ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if($validator->fails()){
                $roles = Role::orderBy('id')->get();
                return new View('site.user_add',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            if (Author::create($request->all())){
                return new View('site.author_add', ['message'=>'Автор добавлен']);
            }


        }
        return new View('site.author_add');
    }

    public function readersList(): string
    {
        return new View('site.readers_list');
    }

    public function booksList(): string
    {
        return new View('site.books_list');
    }


}
