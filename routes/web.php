<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\FilmPemeranController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Author\DashboardController;
use App\Http\Controllers\Author\datafilmController;
use App\Http\Controllers\user\UdashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard bisa diakses oleh semua yang login (User, Admin, Author)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Middleware 'auth' untuk memastikan user login sebelum mengakses halaman profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('user')->middleware(['auth','role:user'])->group(function(){
    Route::get('dashboard', [UdashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/detail/{id}', [UdashboardController::class, 'show'])->name('detail');
    Route::post('/film/{id}/rating', [UdashboardController::class, 'storeRating'])->name('rating.store');


});
// Rute untuk author
Route::prefix('author')->middleware(['auth', 'role:author'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('author.dashboard');
    // Menampilkan film berdasarkan user yang login (author)
    Route::get('index', [datafilmController::class, 'authorIndex'])->name('author.film');
    // Rute untuk menyimpan film baru
    Route::post('/films', [datafilmController::class, 'store'])->name('author.film.store');
    // Rute untuk menghapus film
    Route::delete('/films/{id}', [datafilmController::class, 'destroy'])->name('author.film.destroy');
    Route::post('/film_pemeran/store', [FilmPemeranController::class, 'store'])->name('fp.store');
});
    
// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboardadmin'])->name('admin.dashboard');

    // Routes untuk Author (Admin)

    Route::resource('author', AuthorController::class)->except(['show']); // Menggunakan resource controller, kecuali show jika tidak perlu
    Route::get('author', [AuthorController::class, 'index'])->name('author.index');
    // Routes untuk User (Admin)
    Route::resource('user', UserController::class)->except(['show']); // Menggunakan resource controller, kecuali show jika tidak perlu
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');

    // Routes untuk Film (Admin)
    Route::get('/film', [FilmController::class, 'adminIndex'])->name('admin.film.index');
    Route::post('/film/store', [FilmController::class, 'store'])->name('film.store');
    Route::put('/film/{id}', [FilmController::class, 'update'])->name('film.update');
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('film.destroy');
    Route::get('/film/{id}', [FilmController::class, 'show'])->name('film.show');

    
    // Genre Routes
    // Route::resource('genre',GenreController::class);
    
    // Kategori Routes
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('/genre/store', [GenreController::class, 'store'])->name('genre.store');


    // FilmPemeran Routes
    Route::post('/film_pemeran/store', [FilmPemeranController::class, 'store'])->name('pemeran.store');
});

require __DIR__.'/auth.php';
