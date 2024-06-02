<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


// login, register
Route::redirect('/', 'loginPage');
Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    //admin
    //category
    Route::group(['prefix'=> 'category'], function(){
        Route::get('list', [CategoryController::class, 'list'])->name('category#list');
    });
});

