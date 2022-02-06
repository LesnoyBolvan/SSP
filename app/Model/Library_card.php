<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Auth\IdentityInterface;

class Library_card extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];


}