<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Server;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::put('/server.throttle', function () {

    sleep(2);
    $server = Server::first();

    $server->throttle_active = !$server->throttle_active;
    $server->save();

    
    // $url = request()->header('referer');
    // Log::info('Request URL: ' . $url);
    return to_route('dashboard');
    // return Inertia::share('custom', [
        //     'server' => $server->throttle_active,
        // ]);
        
    })->middleware(['auth', 'verified'])->name('server.throttle');
    
    Route::get('/dashboard', function (Request $request) {


        


        

        return Inertia::render('Dashboard',[
            

                    'server' => Inertia::always(Server::first()->throttle_active),
    
                'type' => request()->header('X-Inertia') ? 'vue' : 'ssr',
        ]);

        
       
    
        // return Inertia::render('Dashboard', [
            //     'server' => Inertia::always(Server::first()->throttle_active),
    // ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/posts', function (Request $request) {

    $request->validate([
        'title' => 'required',
    ]);
    Post::create([
        'title' => $request->title,
        'content' => 'test',
    ]);
    // return Inertia::render('Posts');
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('posts.store');

Route::get('/posts3', function () {
    return Inertia::render('Posts3',[
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
})->middleware(['auth', 'verified'])->name('posts3');

Route::get('/posts', function () {
    

    $server = Server::first();
    if($server->throttle_active){
        sleep(2);
    };
    return Inertia::render('Posts',[
        'user' => 
        // request()->header('X-Inertia') ?  
        //    Inertia::lazy(fn () => tap(User::first(), function (User $user) { 
        //     usleep(3000000);
        // })) 
        // :
            Inertia::defer(fn () => tap(User::first(), function (User $user) {
                usleep(3000000);
            }), 'userGroup1'),

        'user2' => 
        // request()->header('X-Inertia') ?  
        //    Inertia::lazy(fn () =>tap(User::first(), function (User $user) { 
        //     usleep(7000000);
        // })) 
        // :
            Inertia::defer(fn () =>tap(User::first(), function (User $user) { 
                usleep(7000000);
            }), 'userGroup2'),

        'user-posts' => 
        // request()->header('X-Inertia') ? 
        //     fn () => Inertia::defer(fn () => Post::all()->map(function ($post) {
        //         usleep(500000);
        //         return [
        //             'id' => $post->id,
        //             'title' => $post->title. '-ServerTag-'. rand(1, 100),
        //             'content' => $post->content,
        //         ];
        //     }), 'postsGroup1') :
            // fn () => Inertia::merge( Post::all()->map(function ($post) {
            //     usleep(500000);
            //     return [
            //         'id' => $post->id,
            //         'title' => $post->title. '-ServerTag-'. rand(1, 100),
            //         'content' => $post->content,
            //     ];
            // })) :
            Inertia::defer( fn () => Post::all()->map(function ($post) {
                usleep(500000);
                return [
                    'id' => $post->id,
                    'title' => $post->title . '-ServerTag-'. rand(1, 100),
                    'content' => $post->content,
                ];
            }), 'postsGroup1'),

            'type' => request()->header('X-Inertia') ? 'vue' : 'ssr',
    ]);
})->middleware(['auth', 'verified'])->name('posts');

Route::get('/posts.better', function () {
    $server = Server::first();
    if($server->throttle_active){
        sleep(2);
    }

    return Inertia::render('PostsBetter',[
        'server' => $server->throttle_active,
        'user-better' =>  Inertia::defer(fn () => tap(User::first(), fn () => usleep(3000000)), 'userGroup1'),
        'user2-better' => Inertia::defer(fn () => tap(User::first(), fn () => usleep(7000000)), 'userGroup2'),
        'user-posts-better' => Inertia::defer( fn () => Post::all()->map(function ($post) {
                usleep(500000);
                return [
                    'id' => $post->id,
                    'title' => $post->title . ' test'. rand(1, 100),
                    'content' => $post->content,
                ];
            })),
    ]);
})->middleware(['auth', 'verified'])->name('posts.better');

// Route::get('/posts.bad', function () {
//     return Inertia::render('PostsBad',[
//         'user-bad' => tap(User::first(), function (User $user) { 
//             usleep(1000000);
//         }),
//         'user2-bad' => tap(User::first(), function (User $user) { 
//             usleep(3000000);
//         }),
//         'user-posts-bad' => Post::all()->map(function ($post) {
//                 usleep(200000);
//                 return [
//                     'id' => $post->id,
//                     'title' => $post->title. ' test'. rand(1, 100),
//                     'content' => $post->content,
//                 ];
//             } ),
//     ]);
// })->middleware(['auth', 'verified'])->name('posts.bad');

Route::get('/posts.bad', function () {
    return Inertia::render('PostsBad');
})->middleware(['auth', 'verified'])->name('posts.bad');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
