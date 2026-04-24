<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    /**
     * Menampilkan daftar berita
     */
    public function index(Request $request)
    {
        $query = News::with('author');

        // 🔐 ROLE
        if (Auth::user()->role != 'kepala_desa') {
            $query->where(function ($q) {
                $q->where('status', 'published')
                    ->orWhere('author_id', Auth::id());
            });
        }

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhereHas('author', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // 🎯 FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 🧠 FILTER PUNYA SENDIRI
        if ($request->filter == 'mine') {
            $query->where('author_id', Auth::id());
        }

        // 🔽 SORT
        if ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $news = $query->paginate(10)->withQueryString();

        return view('berita.index', compact('news'));
    }

    /**
     * Menampilkan halaman tambah berita
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Menyimpan berita baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        $status = Auth::user()->role == 'kepala_desa'
            ? 'published'
            : 'draft';

        News::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image' => $imagePath,
            'author_id' => Auth::id(),
            'status' => $status
        ]);

        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';

        return redirect()->route($prefix . '.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Menampilkan halaman edit berita
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $this->authorize('update', $news);
        return view('berita.edit', compact('news'));
    }

    /**
     * Mengupdate berita
     */
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $this->authorize('update', $news);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $news->image;

        if ($request->hasFile('image')) {

            // hapus gambar lama
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news', 'public');
        }

        $news->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->content,
            'image' => $imagePath,
            'status' => Auth::user()->role == 'kepala_desa' ? 'published' : 'draft',
            'review_note' => null

        ]);

        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';

        return redirect()->route($prefix . '.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Menghapus berita
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        $this->authorize('delete', $news);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }

    public function publish($id)
    {
        $news = News::findOrFail($id);

        // hanya kepala desa
        if (Auth::user()->role != 'kepala_desa') {
            abort(403);
        }

        $news->status = 'published';
        $news->save();

        return back()->with('success', 'Berita dipublish');
    }

    public function unpublish($id)
    {
        $news = News::findOrFail($id);

        if (Auth::user()->role != 'kepala_desa') {
            abort(403);
        }

        $news->status = 'draft';
        $news->save();

        return back()->with('success', 'Berita dijadikan draft');
    }

    public function submitReview($id)
    {
        $news = News::findOrFail($id);

        // hanya pemilik
        if ($news->author_id != Auth::id()) {
            abort(403);
        }

        $news->status = 'review';
        $news->review_note = null;
        $news->save();

        return back()->with('success', 'Berita dikirim untuk review');
    }

    public function approve($id)
    {
        $news = News::findOrFail($id);

        if (Auth::user()->role != 'kepala_desa') {
            abort(403);
        }

        $news->status = 'published';
        $news->review_note = null;
        $news->save();

        return back()->with('success', 'Berita dipublish');
    }

    public function reject(Request $request, $id)
    {
        $news = News::findOrFail($id);

        if (Auth::user()->role != 'kepala_desa') {
            abort(403);
        }

        $request->validate([
            'review_note' => 'required'
        ]);

        $news->status = 'rejected';
        $news->review_note = $request->review_note;
        $news->save();

        return back()->with('success', 'Berita ditolak');
    }

    public function showInternal($slug)
    {
        $news = News::with('author')->where('slug', $slug)->firstOrFail();
        if ($news->review_note && $news->author_id != Auth::id()) {
            $news->review_note = null;
        }

        return view('berita.show', compact('news'));
    }
}
