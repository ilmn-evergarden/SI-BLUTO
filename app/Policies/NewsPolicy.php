<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;

class NewsPolicy
{
    // semua boleh lihat
    public function view(User $user, News $news)
    {
        return true;
    }

    // hanya kepala atau pemilik
    public function update(User $user, News $news)
    {
        if ($user->role == 'kepala_desa') {
            return true;
        }

        return $news->author_id == $user->id;
    }

    // sama seperti update
    public function delete(User $user, News $news)
    {
        if ($user->role == 'kepala_desa') {
            return true;
        }

        return $news->author_id == $user->id;
    }
}