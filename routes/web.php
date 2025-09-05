<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaPenulisController;
use App\Http\Controllers\KategoriPenulisController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\Webcontroller;
use App\Http\Controllers\KomentarController;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;


Route::get('/', [WebController::class, 'index'])->name('berita.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'profile'])->name('profile.show');
    Route::get('/profile/update', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

});

Route::resource('berita', BeritaController::class);
Route::get('berita', [BeritaController::class, 'index'])->name('berita.show');
Route::get('berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
Route::delete('berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
Route::get('/berita/{slug}', [WebController::class, 'show'])->name('web.show');
Route::post('/berita/{berita}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('web.kategori');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('user', UserController::class);
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



Route::middleware(['auth', 'role:admin, penulis'])->prefix('admin')->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});

Route::middleware(['auth', 'role:penulis'])->prefix('penulis')->group(function () {
    Route::get('/dashboard', [PenulisController::class, 'dashboard'])->name('penulis.dashboard');
    Route::get('kategori', [KategoriPenulisController::class,'index'])->name('penulis.kategori.index');
    Route::get('berita/create', [BeritaPenulisController::class, 'create'])->name('penulis.berita.create');
    Route::get('berita', [BeritaPenulisController::class, 'index'])->name('penulis.berita.index');
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