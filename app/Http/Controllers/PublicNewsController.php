<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class PublicNewsController extends Controller
{
    // =========================
    // LIST BERITA PUBLIK
    // =========================
    public function index(Request $request)
    {
        $query = News::where('status', 'published');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // ⬆⬇ SORT
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        // 🔥 BAGIAN DATA
        $featured = (clone $query)->take(3)->get();
        $latest   = (clone $query)->first();
        $news     = $query->paginate(6)->withQueryString();

        return view('landing.berita.index', compact('featured', 'latest', 'news'));
    }

    // =========================
    // DETAIL BERITA
    // =========================
    public function show($slug)
    {
        $news = News::with('gallery.images')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        $related = News::where('status', 'published')
            ->where('id', '!=', $news->id)
            ->latest()
            ->take(3)
            ->get();

        return view('landing.berita.show', compact('news', 'related'));
    }

    public function home()
    {
        $latestNews = News::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('landing.index', compact('latestNews'));
    }
}
