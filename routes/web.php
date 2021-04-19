<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group(['middleware' =>['auth']] , function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('user/posts',[PostController::class, 'userPosts']);
    Route::get('user/follower',[FollowController::class ,'index']);
    Route::resource('user',UserController::class);
    Route::resource('post',PostController::class);
    Route::resource('like',LikeController::class);
    Route::resource('comment',CommentController::class);
    Route::resource('follow',FollowController::class);
    



});


Auth::routes();

