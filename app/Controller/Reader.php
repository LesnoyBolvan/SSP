<?php

namespace Controller;

use Model\Book;
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

    public function readerCard(): string
    {

        return new View('site.reader_card');
    }
}
