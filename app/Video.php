<?php

namespace Laratube;

class Video extends Model
{
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
