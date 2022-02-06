<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];



    protected static function booted()
    {

//        User::create([
//            'password'=>'123',
//            'login'=>'321',
//        ])->library_card()->create([
//            'valid'=>date('Y-m-d'),
//            'expired'=>'0',
//            'staff'=>'0'
//        ]);
        static::created(function ($user) {
            $user->password = 123;
            $user->login = 321;
            $user->save();
        });
    }

    public function library_card() : HasOne
    {
        return $this->hasOne(Library_card::class, 'login');
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
