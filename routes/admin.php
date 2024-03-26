<?php

use Illuminate\Support\Facades\Route;


//login user
Route::group(['middleware'=>'isLogin'],function(){
Route::get('/login',[\App\Http\Controllers\Auth\LoginController::class,'showLogin'])->name('login');
Route::post('/login',[\App\Http\Controllers\Auth\LoginController::class,'login']);
});

    //register user
    Route::get('/register',[\App\Http\Controllers\Auth\LoginController::class,'showRegister'])->name('register');
    Route::post('/register',[\App\Http\Controllers\Auth\LoginController::class,'showRegister']);




     Route::middleware('auth')->group(function(){

    //home page
    Route::get('/',[\App\Http\Controllers\Admin\HomeController::class,'index'])->name('admin.home');

    //user
    Route::resource('/user', \App\Http\Controllers\Auth\UserController::class)->except('show');
    Route::put('user/update-status/{id}', [\App\Http\Controllers\Auth\UserController::class,'updateStatus'])->name('user.update.status');

    //logout
    Route::post('/logout',[\App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

    //category
    Route::resource('/category', \App\Http\Controllers\Admin\CategoryController::class)->except('show');
    Route::put('category/update-status/{id}', [\App\Http\Controllers\Admin\CategoryController::class,'updateStatus'])->name('category.update.status');
    Route::put('category/update-fstatus/{id}', [\App\Http\Controllers\Admin\CategoryController::class,'updatefStatus'])->name('category.update.fstatus');

    //blog
    Route::resource('/blog', \App\Http\Controllers\Admin\BlogController::class)->except('show');
    Route::put('blog/update-status/{id}', [\App\Http\Controllers\Admin\BlogController::class,'updateStatus'])->name('blog.update.status');

    //settings
    Route::resource('/settings', \App\Http\Controllers\Admin\SettingsController::class)->except('show','index');

    //privacy settings
    Route::resource('/privacy', \App\Http\Controllers\Admin\PrivacyController::class)->except('show','index');
});

