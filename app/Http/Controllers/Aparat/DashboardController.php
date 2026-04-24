<?php

namespace App\Http\Controllers\Aparat;

use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\Gallery;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // statistik
        $today = GuestBook::whereDate('visit_date', today())->count();

        $thisMonth = GuestBook::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->count();
        // 🔴 TAMBAHAN (INI YANG KURANG)
        $myBerita = News::where('author_id', $userId)->count();

        $myGaleri = Gallery::where('created_by', $userId)->count();

        return view('aparat.dashboard', compact(
            'today',
            'thisMonth',
            'myBerita',
            'myGaleri'
        ));
    }
}
