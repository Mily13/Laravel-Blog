<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::controller(PostsController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/add-post', 'newPostForm')->name('add-post');
    Route::post('/add-post', 'insertPost')->name('store-post');
    Route::post('/posts/delete/{id}', 'deletePost')->whereNumber('id')->name('delete-post');
    Route::get('/posts/edit/{id}', 'editPost')->whereNumber('id')->name('edit-post');
    Route::post('/posts/update/{id}', 'updatePost')->whereNumber('id')->name('update-post');
    Route::get('/posts/{id}', 'showPost')->whereNumber('id')->name('show-post');
    Route::get('/filter-posts','filterPost')->name('filter-post');
});
