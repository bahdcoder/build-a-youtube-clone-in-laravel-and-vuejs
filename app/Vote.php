<?php

namespace Laratube;

class Vote extends Model
{
    public function voteable()
    {
        return $this->morphTo();
    }
}
