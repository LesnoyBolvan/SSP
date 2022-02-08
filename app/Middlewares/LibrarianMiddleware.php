<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class LibrarianMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не библиотекарь, то редирект на страницу входа
        if (!Auth::check_librarian()) {
            app()->route->redirect('/login');
        }
    }
}
