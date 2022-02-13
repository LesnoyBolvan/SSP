<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['csrf_token'];

    public function bookAuthors() : HasMany
    {
        return $this->hasMany(BookAuthor::class,  'author_id', 'id');
    }

}
