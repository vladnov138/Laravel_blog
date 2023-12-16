<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;

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
    return redirect('/posts');
});

Route::get('/users', [UserController::class, 'showUsers']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users/create', [UserController::class, 'addUser']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
Route::get('/users/{id}', [UserController::class, 'showUser']);

Route::get('/tags', [TagController::class, 'showTags']);
Route::get('/tags/create', [TagController::class, 'create']);
Route::post('/tags/create', [TagController::class, 'addTag']);
Route::get('/tags/{id}/edit', [TagController::class, 'edit']);
Route::put('/tags/{id}', [TagController::class, 'update']);
Route::delete('/tags/{id}', [TagController::class, 'delete']);
Route::get('/tags/{id}', [TagController::class, 'showTag']);

Route::get('/posts', [PostController::class, 'showPosts']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts/create', [PostController::class, 'addPost']);
Route::get('/posts/{post_id}', [PostController::class, 'showPost']);
Route::get('/posts/{post_id}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post_id}', [PostController::class, 'update']);
Route::delete('/posts/{post_id}', [PostController::class, 'delete']);
Route::delete('/moder/posts/{post_id}', [PostController::class, 'unpublish']);
Route::get('/moder/posts/unpublished', [PostController::class, 'showUnpublishedPosts']);

Route::get('/moder/comments/unpublished', [CommentController::class, 'showUnpublishedComments']);
Route::put('/moder/comments/unpublished/{comment_id}', [CommentController::class, 'publish']);
Route::delete('/moder/comments/{comment_id}', [CommentController::class, 'delete']);
Route::post('/posts/{post_id}/comments', [CommentController::class, 'addComment']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
