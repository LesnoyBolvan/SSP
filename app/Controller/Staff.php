<?php

namespace Controller;

use Model\Author;
use Model\Book;
use Model\BookAuthor;
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
        $roles = Role::orderBy('id')->get();
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
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'roles'=>$roles]);
            }
            $pass = User::password();
            $user = User::create([
                'login'=>random_int(1000, 10000),
                'password'=> $pass,
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

        return (new View())->render('site.user_add', ['roles'=>$roles]);
    }

    public function bookAdd(Request $request): string
    {
        $authors = Author::all();
        if ($request->method==='POST'){
            $file = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $path = app()->settings->getUploadPath();
            move_uploaded_file($file_tmp, $path.$file);

            $validator = new Validator($request->all(), [
                'title'=> ['required'],
                'annotation'=> ['required'],
                'year'=> ['required'],
                'image'=> ['required', 'fileType'],
                'price'=>['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'fileType'=>'Недопустимое разрешение файла',
            ]);

            if($validator->fails()){
                return new View('site.book_add',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'authors'=>$authors]);
            }

            if($book = Book::create($request->all())){
                $book->image = $file;
                $book->save();
                BookAuthor::create([
                    'author_id'=>$request->author_id,
                    'book_id'=>$book->id
                ]);
                return new View('site.book_add', ['message'=>'Книга добавлена', 'authors'=>$authors]);
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

    public function bookDelete(Request $request): string
    {
        Book::where('id', $request->id)->delete();
        $books = Book::all();
        app()->route->redirect('/books_list');
        return new View('site.books_list', ['books' => $books]);

    }

    public function bookRegister(Request $request): string
    {
        $books = BookAuthor::all();
        $users = User::where('role_id', '!=', 3)->get();
        if ($request->method==='POST'){

            if($rent = RentedBook::create($request->all())){
                $rent->rented=date('Y-m-d');
                $rent->save();
                $count = BookAuthor::where('id', $request->book_authors_id)->first();
                $count->count += 1;
                $count->save();
                return new View('site.book_register', ['message'=>'Книга оформлена', 'books'=>$books, 'users'=>$users]);
            }
        }
        return new View('site.book_register', ['books'=>$books, 'users'=>$users]);
    }

    public function readersList(Request $request): string
    {
        if($request->method==='POST'){
            $search = $request->search;
            $book = Book::where('title', $search)->first('id');
            $ba = BookAuthor::whereIn('book_id', $book)->first('id');
            $rent = RentedBook::whereIn('book_authors_id', $ba)->get('user_id');
            $users = User::whereIn('id', $rent)->get();
            file_put_contents('txt.txt', $users);
            return new View('site.readers_list', ['users' => $users]);
        }

        $users = User::where('role_id', '!=', 3)->get();
        return new View('site.readers_list', ['users' => $users]);
    }

    public function booksList(Request $request): string
    {
        if($request->method==='POST'){
            $search = $request->search;
            $user = User::where('first_name',$search)->orWhere('last_name',$search)->orWhere('login', $search)->first();
//            $book = Book::get()->rented->user->where('first_name',$search)->orWhere('last_name',$search)->orWhere('login', $search)->toArray();
            $rb = RentedBook::where('user_id', $user->id)->get('book_authors_id')->toArray();
            $ab = BookAuthor::whereIn('id', $rb)->get('book_id');
            $book = Book::whereIn('id', $ab)->get();
            file_put_contents('txt.txt', $ab);
            return new View('site.books_list', ['books' => $book]);
        }
        $books = Book::all();
        return new View('site.books_list', ['books' => $books]);
    }

    public function authorsList(): string
    {
        $authors = Author::all();
        return new View('site.authors_list', ['authors' => $authors]);
    }

    public function authorDelete(Request $request): string
    {
        Author::where('id', $request->id)->delete();
        $authors = Author::all();
        app()->route->redirect('/authors_list');
        return new View('site.authors_list', ['authors' => $authors]);
    }
}
