<?php

namespace Laratube;

class Comment extends Model
{
    protected $with = ['user'];

    protected $appends = ['repliesCount'];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function getRepliesCountAttribute()
    {
        return $this->replies->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }
}
