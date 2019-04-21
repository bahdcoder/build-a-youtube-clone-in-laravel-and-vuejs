<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Video;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        return $video;
    }
}
