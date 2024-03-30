<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/test', [PostController::class, 'exampleTest']);
Route::get('/test2', [PostController::class, 'exampleTest2']);
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/user/{id}/{locale?}', [PostController::class, 'user'])->name('posts.user');
Route::get('/toggleFollow/{user}', [PostController::class, 'toggleFollow'])->middleware(['auth', 'verified'])->name('toggleFollow');
Route::resource('posts', PostController::class)
    ->only(['edit', 'update', 'create', 'store', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('posts', PostController::class)
    ->only(['show']);
//Route::get('/posts/{id}/{locale?}', [PostController::class, 'show'])->name('posts.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'image'])->name('profile.image');
});

require __DIR__.'/auth.php';
