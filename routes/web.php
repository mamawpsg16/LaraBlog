<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewsletterController;
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
Route::get('/',[PostController::class,'index'])->name('posts.index');

/** POST SHOW */
Route::get('post/{post:slug}',[PostController::class,'show'])->name('posts.show');

/** NEWSLETTER */
Route::post('/newsletter', NewsletterController::class)->name('newsletter.signup');

Route::group(['middleware' => ['guest']],function(){
    
    /** LOGIN & REGISTER */
    Route::get('/register',[RegisterController::class,'create'])->name('register');
    Route::post('/register/store',[RegisterController::class,'store'])->name('register.store');
    Route::post('/login',[SessionController::class,'store'])->name('login.store');
    Route::get('/login',[SessionController::class,'create'])->name('login');
    
});

Route::group(['middleware'=>['auth']], function(){
    /** LOGOUT */
    Route::post('/logout',[SessionController::class,'destroy'])->name('logout');

    /** COMMENT */
    Route::post('post/{post:slug}/comments',[PostCommentsController::class,'store'])->name('comment.store');

    /** ADMIN */
    Route::group(['middleware' => ['admin'],'prefix'=>'admin','as' => 'admin.'],function(){
        Route::resource('/posts',Admincontroller::class)->except('show');
    });
});



    