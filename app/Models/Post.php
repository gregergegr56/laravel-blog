<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Заполняемые поля
    protected $fillable = [
        'title',
        'body',
        'author',
    ];
}
