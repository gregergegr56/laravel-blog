<?php

namespace App\Events;

use App\Models\Post;

// Событие «статья опубликована»
class PostCreated
{
    public function __construct(public Post $post)
    {
        //
    }
}
