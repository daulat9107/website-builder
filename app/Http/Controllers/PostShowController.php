<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostShowController extends Controller
{
    public function __invoke (Post $post)
    {
        return new PostResource($post);
    }
}
