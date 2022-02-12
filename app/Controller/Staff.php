<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Model\LibraryCard;
use Model\RentedBook;
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

    public function bookRegister(Request $request): string
    {
        if ($request->method==='POST' && RentedBook::create($request->all())){
            return new View('site.book_add', ['message'=>'Книга оформлена']);
        }
        $books = Book::all();
        $users = User::where('role_id', '!=', 3)->get();
        return new View('site.book_register', ['books'=>$books, 'users'=>$users]);
    }

    public function bookAdd(Request $request): string
    {
        $authors = Author::all();
        if ($request->method==='POST'){
            $file = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $path = app()->settings->getUploadPath();
//            $type_valid = ['image/jpeg','image/jpg','image/png'];
//            if(in_array())
            move_uploaded_file($file_tmp, $path.$file);

            $validator = new Validator($request->all(), [
                'title'=> ['required'],
                'annotation'=> ['required'],
                'year'=> ['required'],
                'image'=> ['required'],
                'new_edition'=>['required'],
                'price'=>['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
//                'fileType'=>'Недопустимое разрешение файла',
            ]);

            if($validator->fails()){
                return new View('site.book_add',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if($book = Book::create($request->all())){
                $book->image = $file;
                $book->save();
                return new View('site.book_add', ['message'=>'Книга добавлена','authors'=>$authors]);
            }

        }
        return new View('site.book_add',['authors'=>$authors]);
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
        $users = User::where('role_id', '!=', 3)->get();
        return new View('site.readers_list', ['users' => $users]);
    }

    public function booksList(): string
    {
        $books = Book::all();
        return new View('site.books_list', ['books' => $books]);
    }

    public function bookDelete(Request $request): string
    {
        Book::where('id', $request->id)->delete();
        $books = Book::all();
        app()->route->redirect('/books_list');

        return (new View())->render('site.books_list', ['books' => $books]);

    }

    public function authorsList(): string
    {
        $authors = Author::all();
        return new View('site.authors_list', ['authors' => $authors]);
    }

}
