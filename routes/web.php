<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
});
Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('berita', [BeritaController::class, 'store'])->name('berita.store');
Route::get('berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::put('berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
Route::delete('berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

Route::resource('user', UserController::class);

require __DIR__.'/auth.php';
