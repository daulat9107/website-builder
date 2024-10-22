<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostIndexController extends Controller
{
    public function __invoke () 
    {
        return PostResource::collection(Post::wherePublished(true)->get());
    }
}
