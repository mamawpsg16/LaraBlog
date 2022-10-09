<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostCommentsController;

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


/** HOME */
Route::get('/',PostsController::class)->name('posts.index');



/** NEWSLETTER */
Route::post('/newsletter', NewsletterController::class)->name('newsletter.signup');

Route::post('/login',[SessionController::class,'store'])->name('login.store');
Route::post('/register/store',[RegisterController::class,'store'])->name('register.store');

Route::group(['middleware' => ['guest']],function(){
    /** LOGIN & REGISTER */
    Route::get('/register',[RegisterController::class,'create'])->name('register');
    Route::get('/login',[SessionController::class,'create'])->name('login');
    
});

Route::group(['middleware'=>['auth']], function(){
    /** LOGOUT */
    Route::post('/logout',[SessionController::class,'destroy'])->name('logout');

    /** COMMENT */
    Route::post('post/{post:slug}/comments',[PostCommentsController::class,'store'])->name('comment.store');

    /** PROFILE */
    Route::get('/user/profile',[ProfileController::class,'index'])->name('profile');
    Route::get('/user/profile/edit',[ProfileController::class,'edit'])->name('profile.edit');
    Route::get('/user/profile/{id:username}',[ProfileController::class,'show'])->name('profile.show');
    Route::patch('/user/profile/update',[ProfileController::class,'update'])->name('profile.update');
    Route::post('/user/profile/follow',[ProfileController::class,'store'])->name('profile.follow');

    /** POST SHOW */
    Route::get('post/{post:slug}',[PostController::class,'show'])->name('posts.show');
    Route::post('post/like',[PostController::class,'likePost'])->name('posts.like');
    Route::resource('/posts',PostController::class)->except('show');
 
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);
});



    