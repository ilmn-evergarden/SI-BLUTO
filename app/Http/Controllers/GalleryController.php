<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    // =========================
    // 📌 INDEX
    // =========================
    public function index(Request $request)
    {
        $query = Gallery::with('images');

        // 🔐 ROLE FILTER (JANGAN DIUBAH LOGIC INI)
        if (Auth::user()->role != 'kepala_desa') {
            $query->where(function ($q) {
                $q->where('status', 'published')
                    ->orWhere('created_by', Auth::id());
            });
        }

        // 🔍 SEARCH
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // 🏷 FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // 👤 FILTER KEPEMILIKAN
        if ($request->ownership == 'mine') {
            $query->where('created_by', Auth::id());
        }

        // ⬆⬇ SORTING
        if ($request->sort == 'oldest') {
            $query->oldest();
        } else {
            $query->latest(); // default
        }

        $galleries = $query->paginate(10)->withQueryString();

        return view('gallery.index', compact('galleries'));
    }

    // =========================
    // 📌 CREATE
    // =========================
    public function create()
    {
        $news = News::doesntHave('gallery')->get();
        return view('gallery.create', compact('news'));
    }

    // =========================
    // 📌 STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:5120',
            'news_id' => 'nullable|exists:news,id'
        ]);

        // 🔥 CEK DUPLIKAT (ONE-TO-ONE PROTECTION)
        if ($request->news_id) {
            $exists = Gallery::where('news_id', $request->news_id)->exists();

            if ($exists) {
                return back()
                    ->withInput()
                    ->with('error', 'Berita ini sudah memiliki galeri!');
            }
        }

        // 🔐 STATUS OTOMATIS
        $status = Auth::user()->role == 'kepala_desa'
            ? 'published'
            : 'draft';

        // 🧱 SIMPAN GALERI
        $gallery = Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'news_id' => $request->news_id,
            'created_by' => Auth::id(),
            'status' => $status
        ]);

        // 🖼 SIMPAN GAMBAR
        foreach ($request->file('images') as $index => $image) {

            $path = $image->store('gallery', 'public');

            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image' => $path,
                'order' => $index
            ]);
        }

        // 🔁 REDIRECT
        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';

        return redirect()->route($prefix . '.gallery.index')
            ->with('success', 'Galeri berhasil dibuat');
    }

    // =========================
    // 📌 EDIT
    // =========================
    public function edit($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);
        $news = News::all();

        return view('gallery.edit', compact('gallery', 'news'));
    }

    // =========================
    // 📌 UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);

        // 🔥 VALIDASI MINIMAL 1 GAMBAR
        $existing = $gallery->images->count();
        $new = $request->file('images') ? count($request->file('images')) : 0;

        if (($existing + $new) == 0) {
            return back()->with('error', 'Minimal harus ada 1 gambar');
        }

        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
            'news_id' => $request->news_id
        ]);

        // 🔥 LOGIC STATUS
        if ($gallery->status == 'rejected') {
            $gallery->status = 'draft';
        }


        $gallery->save();

        // 🔥 TAMBAH GAMBAR BARU
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {

                $path = $image->store('gallery', 'public');

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image' => $path,
                    'order' => $index
                ]);
            }
        }

        return back()->with('success', 'Galeri berhasil diperbarui');
    }

    // =========================
    // 📌 STATUS
    // =========================
    public function approve($id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->status = 'published';
        $gallery->review_note = null;
        $gallery->save();

        return back()->with('success', 'Galeri dipublish');
    }

    public function reject(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'review_note' => 'required'
        ]);

        $gallery->status = 'rejected';
        $gallery->review_note = $request->review_note;
        $gallery->save();

        return back()->with('success', 'Galeri ditolak');
    }

    public function submitReview($id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->status = 'review';
        $gallery->save();

        return back()->with('success', 'Dikirim ke kepala desa');
    }

    // =========================
    // 📌 DELETE GALLERY
    // =========================
    public function destroy($id)
    {
        $gallery = Gallery::with('images')->findOrFail($id);

        // hapus semua file
        foreach ($gallery->images as $img) {
            Storage::disk('public')->delete($img->image);
        }

        $gallery->delete();

        return back()->with('success', 'Galeri berhasil dihapus');
    }

    // =========================
    // 📌 DELETE IMAGE (PENTING)
    // =========================
    public function deleteImage($id)
    {
        $image = GalleryImage::findOrFail($id);

        $galleryId = $image->gallery_id;

        // hapus file
        Storage::disk('public')->delete($image->image);

        // hapus database
        $image->delete();

        $prefix = Auth::user()->role == 'kepala_desa' ? 'kepala' : 'aparat';

        return redirect()->route($prefix . '.gallery.edit', $galleryId)
            ->with('success', 'Gambar berhasil dihapus');
    }

    // =========================
    // 📌 SHOW
    // =========================
    public function show($id)
    {
        $gallery = Gallery::with('images', 'news')->findOrFail($id);

        return view('gallery.show', compact('gallery'));
    }
}
