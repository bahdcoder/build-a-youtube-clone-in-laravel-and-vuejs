<?php

namespace Laratube;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Channel extends Model implements HasMedia
{
    use HasMediaTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        if ($this->media->first()) {
            return $this->media->first()->getFullUrl('thumb');
        }

        return null;
    }

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }
}
