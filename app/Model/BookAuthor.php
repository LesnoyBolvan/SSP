<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class BookAuthor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['csrf_token'];

    public function author() : BelongsTo
    {
        return $this->BelongsTo(Author::class, 'author_id', 'id');
    }

    public function book() : BelongsTo
    {
        return $this->BelongsTo(Book::class, 'book_id', 'id');
    }


}
