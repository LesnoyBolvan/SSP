<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['csrf_token', 'image'];

    public function bookAuthors() : HasMany
    {
        return $this->hasMany(BookAuthor::class,  'book_id', 'id');
    }

    public function rented() : HasManyThrough
    {
        return $this->hasManyThrough(RentedBook::class, BookAuthor::class, 'book_id', 'book_authors_id', 'id', 'id');
    }

}
