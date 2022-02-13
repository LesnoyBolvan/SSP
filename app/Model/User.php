<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

//    protected static function booted()
//    {
//        static::created(function ($user) {
//            $user->password = 123;
//            $user->login = random_int(1000, 10000);
//            $user->save();
//        });
//    }

    public static function password(): string
    {
        $chars = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $size = strlen($chars) - 1;
        $password = '';
        for($i = 0; $i < 11; $i++) {
            $password .= $chars[random_int(0, $size)];
        }
        return $password;
    }

    public function role() : HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function user() : HasMany
    {
        return $this->hasMany(RentedBook::class, 'user_id', 'id');
    }


        //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' => $credentials['password']])->first();
    }
}
