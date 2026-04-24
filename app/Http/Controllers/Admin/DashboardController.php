<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GuestBook;
use App\Models\News;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // semua aparat
        $aparat = User::where('role', 'aparat_desa');

        // total aparat
        $totalAparat = $aparat->count();

        // aparat aktif
        $aktif = GuestBook::select('created_by')
            ->distinct()
            ->pluck('created_by');

        $aktifCount = User::whereIn('id', $aktif)
            ->where('role', 'aparat_desa')
            ->count();

        // terbaru
        $latest = User::where('role', 'aparat_desa')
            ->latest()
            ->take(5)
            ->get();

        // total kunjungan bulan ini
        $kunjunganBulan = GuestBook::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->count();

        $totalBerita = News::count();
        $totalGaleri = Gallery::count();

        return view('kepala.dashboard', compact(
            'totalAparat',
            'kunjunganBulan',
            'totalBerita',
            'totalGaleri'
        ));
    }
}
