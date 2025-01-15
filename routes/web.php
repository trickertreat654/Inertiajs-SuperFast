<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\User;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/posts', function () {
    return Inertia::render('Posts',[
        'posts' => request()->header('X-Inertia') ? 
            fn () => Inertia::merge( Post::all()->map(function ($post) {
                usleep(400000);
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                ];
            })) :
            Inertia::defer( fn () => Post::all()->map(function ($post) {
                usleep(400000);
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                ];
            })),
    ]);
})->middleware(['auth', 'verified'])->name('posts');

Route::get('/posts2', function () {
    return Inertia::render('Posts2',[
        'type' => request()->header('X-Inertia') ? 'vue' : 'ssr',
        'user' => request()->header('X-Inertia') ?  
           fn () => User::first() :
            Inertia::defer(fn () => User::first(), 'nameGroup'),
        'posts' => request()->header('X-Inertia') ? 
            fn () => Inertia::merge( Post::all()->map(function ($post) {
                usleep(300000);
                return [
                    'id' => $post->id,
                    'title' => $post->title. ' test',
                    'content' => $post->content,
                ];
            })) :
            Inertia::defer( fn () => Post::all()->orderBy('id', 'desc')->map(function ($post) {
                usleep(300000);
                return [
                    'id' => $post->id,
                    'title' => $post->title . ' test',
                    'content' => $post->content,
                ];
            })),
    ]);
})->middleware(['auth', 'verified'])->name('posts2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
