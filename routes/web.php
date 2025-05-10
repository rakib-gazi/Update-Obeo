<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'homePage'])->name('homePage');

//login
Route::post('/login', [UserController::class, 'login'])->name('login');
//logout
Route::get('/logout', [UserController::class,'logout'])->name('logout');





//user route

Route::middleware([TokenVerificationMiddleware::class])
    ->group(function () {
        Route::get('/dashboard',[DashboardController::Class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/users',[UserController::class,'getUsers'])->name('getUsers');
        Route::post('/dashboard/users',[UserController::class,'addUser'])->name('addUser');
        Route::put('/dashboard/users/{id}',[UserController::class,'updateUser'])->name('updateUser');
        Route::get('/dashboard/delete-user/{id}', [UserController::class,'deleteUser'])->name('deleteUser');
    });
