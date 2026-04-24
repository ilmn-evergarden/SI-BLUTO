<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_id',
        'image',
        'order'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    protected static function booted()
    {
        static::deleting(function ($image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image);
        });
    }
}
