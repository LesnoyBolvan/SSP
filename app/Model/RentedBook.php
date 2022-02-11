<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedBook extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['csrf_token'];



}
