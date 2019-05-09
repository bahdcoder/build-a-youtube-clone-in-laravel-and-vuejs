<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Video;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return $video->comments()->paginate(5);
    }
}
