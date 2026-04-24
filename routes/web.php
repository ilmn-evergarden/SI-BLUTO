<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\LetterTypeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicNewsController;
use App\Http\Controllers\PublicGalleryController;
use App\Http\Controllers\Aparat\DashboardController as AparatDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;


Route::get('/', function () {
    return view('landing/index');
});

Route::get('/profil-desa', function () {
    return view('landing/profil');
});

Route::get('/berita', function () {
    return view('landing/berita');
});

Route::get('/galeri', function () {
    return view('landing/galeri');
});

Route::get('/buku-tamu', function () {
    return view('landing/buku_tamu');
});

Route::get('/kontak', function () {
    return view('landing/kontak');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/chart/guest', [GuestBookController::class, 'chart'])
        ->name('guest.chart');
}); 


Route::middleware(['auth', 'role:kepala_desa', 'prevent-back'])->group(function () {

    Route::get('/kepala/dashboard', [AdminDashboard::class, 'index'])
        ->name('kepala.dashboard');

    //Tambah User Aparat Desa
    Route::get('/kepala/aparat', [UserController::class, 'index'])->name('aparat.index');
    Route::post('/kepala/aparat', [UserController::class, 'store'])->name('aparat.store');
    Route::put('/kepala/aparat/{id}', [UserController::class, 'update'])->name('aparat.update');
    Route::delete('/kepala/aparat/{id}', [UserController::class, 'destroy'])->name('aparat.destroy');

    Route::prefix('kepala')->name('kepala.')->group(function () {
        Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
        Route::get('/berita/create', [NewsController::class, 'create'])->name('berita.create');
        Route::post('/berita', [NewsController::class, 'store'])->name('berita.store');
        Route::get('/berita/{id}/edit', [NewsController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [NewsController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [NewsController::class, 'destroy'])->name('berita.destroy');
    });

    Route::prefix('kepala')->name('kepala.')->group(function () {
        Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/galeri/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/galeri', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/galeri/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/galeri/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/galeri/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::delete('/galeri/image/{id}', [GalleryController::class, 'deleteImage'])
            ->name('gallery.deleteImage');
        Route::get('/galeri/{id}', [GalleryController::class, 'show'])
            ->name('gallery.show');
        Route::post('/galeri/{id}/approve', [GalleryController::class, 'approve'])
            ->name('gallery.approve');
        Route::post('/galeri/{id}/reject', [GalleryController::class, 'reject'])
            ->name('gallery.reject');
        Route::post('/galeri/{id}/review', [GalleryController::class, 'submitReview'])
            ->name('aparat.gallery.submitReview');
    });

    Route::get('/kepala/berita/{slug}', [NewsController::class, 'showInternal'])
        ->name('kepala.berita.show');
    Route::get('/kepala/buku-tamu', [GuestBookController::class, 'indexKepala'])
        ->name('kepala.bukutamu');
    Route::get('/kepala/guest/export', [GuestBookController::class, 'export'])->name('kepala.guest.export');
    Route::post('/kepala/berita/{id}/publish', [NewsController::class, 'publish'])
        ->name('kepala.berita.publish');
    Route::post('/kepala/berita/{id}/unpublish', [NewsController::class, 'unpublish'])
        ->name('kepala.berita.unpublish');
    Route::post('/kepala/berita/{id}/approve', [NewsController::class, 'approve'])
        ->name('kepala.berita.approve');
    Route::post('/kepala/berita/{id}/reject', [NewsController::class, 'reject'])
        ->name('kepala.berita.reject');

});


Route::middleware(['auth', 'role:aparat_desa', 'prevent-back'])->group(function () {

    Route::get('/aparat/dashboard', function () {
        return view('aparat.dashboard');
    })->name('aparat.dashboard');

    /// berita
    Route::get('/aparat/berita', [NewsController::class, 'index'])->name('aparat.berita.index');
    Route::get('/aparat/berita/create', [NewsController::class, 'create'])->name('aparat.berita.create');
    Route::post('/aparat/berita', [NewsController::class, 'store'])->name('aparat.berita.store');
    Route::get('/aparat/berita/{id}/edit', [NewsController::class, 'edit'])->name('aparat.berita.edit');
    Route::put('/aparat/berita/{id}', [NewsController::class, 'update'])->name('aparat.berita.update');
    Route::delete('/aparat/berita/{id}', [NewsController::class, 'destroy'])->name('aparat.berita.destroy');
    Route::get('/aparat/berita/{slug}', [NewsController::class, 'showInternal'])
        ->name('aparat.berita.show');
    Route::post('/aparat/berita/{id}/submit-review', [NewsController::class, 'submitReview'])
        ->name('aparat.berita.submitReview');

    //buku tamu
    Route::get('/letter-types/manage', [LetterTypeController::class, 'index'])
    ->name('letter-types.manage');
    Route::get('/buku-tamu', [GuestBookController::class, 'index'])->name('guest.index');
    Route::get('/buku-tamu/create', [GuestBookController::class, 'create'])->name('guest.create');
    Route::post('/buku-tamu', [GuestBookController::class, 'store'])->name('guest.store');
    Route::post('/letter-types', [LetterTypeController::class, 'store'])
        ->name('letter-types.store');
    Route::resource('letter-types', LetterTypeController::class)
        ->except(['create', 'show']);
    Route::get('/guest/export', [GuestBookController::class, 'export'])->name('guest.export');
    Route::get('/buku-tamu/{id}/edit', [GuestBookController::class, 'edit'])->name('guest.edit');
    Route::put('/buku-tamu/{id}', [GuestBookController::class, 'update'])->name('guest.update');

    Route::prefix('aparat')->name('aparat.')->group(function () {
        Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/galeri/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('/galeri', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('/galeri/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::put('/galeri/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/galeri/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::delete('/galeri/image/{id}', [GalleryController::class, 'deleteImage'])
            ->name('gallery.deleteImage');
        Route::get('/galeri/{id}', [GalleryController::class, 'show'])
            ->name('gallery.show');
        Route::post('/gallery/{id}/submit-review', [GalleryController::class, 'submitReview'])
            ->name('gallery.submitReview');
    });

    Route::get('/aparat/dashboard', [AparatDashboard::class, 'index'])
        ->name('aparat.dashboard');
});

Route::get('/berita', [PublicNewsController::class, 'index'])
    ->name('public.berita.index');

Route::get('/berita/{slug}', [PublicNewsController::class, 'show'])
    ->name('public.berita.show');

Route::get('/gallery', [PublicGalleryController::class, 'index'])
    ->name('public.gallery.index');

Route::get('/gallery/{id}', [PublicGalleryController::class, 'show'])
    ->name('public.gallery.show');

Route::get('/', [PublicNewsController::class, 'home']);
Route::get('/', [PublicGalleryController::class, 'home']);
