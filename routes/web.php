<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostsController::class , 'getPosts'])->name('posts');

Route::get('/post/{id}', [App\Http\Controllers\PostsController::class , 'post'])->name('post');

Route::get('/blogSearch', [App\Http\Controllers\PostsController::class , 'blogSearch'])->name('blogSearch');


// Route::post('/commentPost', [App\Http\Controllers\PostsController::class , 'commentPost'])->name('commentPost');

Route::get('/blogCategory/{id}', [App\Http\Controllers\PostsController::class , 'blogCategory'])->name('blogCategory');

// Route::get('subscribe')

