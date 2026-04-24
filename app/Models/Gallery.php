<?php

namespace App\Models;

use App\Models\GalleryImage;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'news_id',
        'cover_image',
        'status',
        'review_note',
        'created_by'
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}

