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

class Reader
{
    public function book(): string
    {
        return new View('site.book');
    }

    public function books(): string
    {
        return new View('site.books');
    }

    public function reader_card(): string
    {
        return new View('site.reader_card');
    }
}
