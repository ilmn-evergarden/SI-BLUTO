<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

class PublicGalleryController extends Controller
{
    // =========================
    // LIST GALERI
    // =========================
    public function index(Request $request)
    {
        $query = Gallery::with(['images', 'news'])
            ->where('status', 'published');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $galleries = $query->latest()
            ->paginate(9)
            ->withQueryString();

        return view('landing.gallery.index', compact('galleries'));
    }

    // =========================
    // DETAIL GALERI
    // =========================
    public function show($id)
    {
        $gallery = Gallery::with(['images', 'news'])
            ->where('status', 'published')
            ->findOrFail($id);

        return view('landing.gallery.show', compact('gallery'));
    }

    // =========================
    // HOMEPAGE
    // =========================
    public function home()
    {
        // 🔥 berita terbaru
        $latestNews = News::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        // 🔥 galeri terbaru
        $latestGalleries = Gallery::with(['images', 'news'])
            ->where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('landing.index', compact('latestNews', 'latestGalleries'));
    }
}