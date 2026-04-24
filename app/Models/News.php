<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';

    protected $fillable = [

        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'status',
        'review_note'

    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

public function gallery()
{
    return $this->hasOne(\App\Models\Gallery::class);
}
}
