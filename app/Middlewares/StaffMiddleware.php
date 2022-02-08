<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class StaffMiddleware
{
    public function handle(Request $request)
    {
        //Если пользователь не персонал, то редирект на страницу входа
        if (!Auth::check_staff()) {
            app()->route->redirect('/login');
        }
    }
}
