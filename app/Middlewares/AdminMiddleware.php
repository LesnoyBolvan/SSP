<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class AdminMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не админ, то редирект на страницу входа
        if (!Auth::check_admin()) {
            app()->route->redirect('/login');
        }
    }
}
