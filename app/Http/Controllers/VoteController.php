<?php

namespace Laratube\Http\Controllers;

use Illuminate\Http\Request;
use Laratube\Video;

class VoteController extends Controller
{
    public function vote(Video $video, $type) {
        return auth()->user()->toggleVote($video, $type);
    }
}
