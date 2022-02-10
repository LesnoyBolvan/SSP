<?php

namespace Src\Auth;

use http\Client\Curl\User;
use Model\Library_card;
use Model\LibraryCard;
use Model\Role;
use Src\Session;

class Auth
{
    //Свойство для хранения любого класса, реализующего интерфейс IdentityInterface
    private static IdentityInterface $user;

    //Инициализация класса пользователя
    public static function init(IdentityInterface $user): void
    {
        self::$user = $user;
        if (self::user()) {
            self::login(self::user());
        }
    }

    //Вход пользователя по модели
    public static function login(IdentityInterface $user): void
    {
        self::$user = $user;
        Session::set('id', self::$user->getId());
    }

    //Аутентификация пользователя и вход по учетным данным
    public static function attempt(array $credentials): bool
    {
        if ($user = self::$user->attemptIdentity($credentials)) {
            self::login($user);
            return true;
        }
        return false;
    }

    //Возврат текущего аутентифицированного пользователя
    public static function user()
    {
        $id = Session::get('id') ?? 0;
        return self::$user->findIdentity($id);
    }

    //Проверка является ли текущий пользователь аутентифицированным
    public static function check(): bool
    {
        if (self::user()) {
            return true;
        }
        return false;
    }

    public static function check_admin(): bool
    {
        if (Role::where('id', self::user()['role_id'])->first()['code'] === 'admin') {
            return true;
        }
        return false;
    }

    public static function check_librarian(): bool
    {
        if (Role::where('id', self::user()['role_id'])->first()['code'] === 'librarian') {
            return true;
        }
        return false;
    }

    public static function check_staff(): bool
    {
        if (LibraryCard::where('number', self::user()['login'])->first()['staff'] === 1) {
            return true;
        }
        return false;
    }

    //Генерация нового токена для CSRF
    public static function generateCSRF(): string
    {
        $token = md5(time());
        Session::set('csrf_token', $token);
        return $token;
    }


    //Выход текущего пользователя
    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }

}
