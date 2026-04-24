<?php

namespace App\Policies;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\User;

class GalleryPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa lihat list
    }

    public function view(User $user, Gallery $gallery): bool
    {
        if ($user->role == 'kepala_desa') {
            return true;
        }
        
        return $gallery->status == 'published' || $gallery->created_by == $user->id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['kepala_desa', 'aparat_desa']);
    }

    public function update(User $user, Gallery $gallery): bool
    {
        if ($user->role == 'kepala_desa') {
            return true;
        }
        return $gallery->created_by == $user->id;
    }

    public function delete(User $user, Gallery $gallery): bool
    {
        if ($user->role == 'kepala_desa') {
            return true;
        }
        return $gallery->created_by == $user->id;
    }

    public function deleteImage(User $user, GalleryImage $image): bool
    {
        $gallery = $image->gallery;
        if (!$gallery) {
            return false;
        }
        
        if ($user->role == 'kepala_desa') {
            return true;
        }
        return $gallery->created_by == $user->id;
    }

    public function restore(User $user, Gallery $gallery): bool
    {
        return false;
    }

    public function forceDelete(User $user, Gallery $gallery): bool
    {
        return false;
    }
}