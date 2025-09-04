<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaPenulisController;
use App\Http\Controllers\KategoriPenulisController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'index'])->name('web.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
});
Route::resource('berita', BeritaController::class);
Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
Route::delete('berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
Route::get('/berita/{slug}', [WebController::class, 'show'])->name('web.show');
Route::post('/berita/{berita}/komentar', [\App\Http\Controllers\KomentarController::class, 'store'])->name('komentar.store');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');



Route::resource('user', UserController::class);
Route::middleware(['auth', 'role:penulis'])->prefix('penulis')->group(function () {
    Route::get('/dashboard', [PenulisController::class, 'dashboard'])->name('penulis.dashboard');

    Route::get('kategori', [KategoriPenulisController::class,'index'])->name('penulis.kategori.index');
    
    Route::get('berita', [BeritaPenulisController::class, 'index'])->name('penulis.berita.index');
    Route::get('berita/create', [BeritaPenulisController::class, 'create'])->name('penulis.berita.create');
    Route::post('berita', [BeritaPenulisController::class, 'store'])->name('penulis.berita.store');
    Route::get('berita/{berita}/edit', [BeritaPenulisController::class, 'edit'])->name('penulis.berita.edit');
    Route::put('berita/{berita}', [BeritaPenulisController::class, 'update'])->name('penulis.berita.update');
    Route::delete('berita/{berita}', [BeritaPenulisController::class, 'destroy'])->name('penulis.berita.destroy');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'penulis') {
            return redirect('/penulis/dashboard');
        } else {
            return redirect('/'); 
        }
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
