<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'homePage'])->name('homePage');

//login
Route::post('/login', [UserController::class, 'login'])->name('login');
//logout
Route::get('/logout', [UserController::class,'logout'])->name('logout');







Route::middleware([TokenVerificationMiddleware::class])
    ->group(function () {
        //user route
        Route::get('/dashboard',[DashboardController::Class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/users',[UserController::class,'getUsers'])->name('getUsers');
        Route::post('/dashboard/users',[UserController::class,'addUser'])->name('addUser');
        Route::put('/dashboard/users/{id}',[UserController::class,'updateUser'])->name('updateUser');
        Route::get('/dashboard/delete-user/{id}', [UserController::class,'deleteUser'])->name('deleteUser');

        // settings route
        Route::get('/dashboard/settings',[SettingsController::class, 'settings'])->name('settings');

        // Hotel Settings updateHotel
        Route::get('dashboard/settings/hotel-settings',[SettingsController::class, 'getHotels'])->name('getHotels');
        Route::post('/dashboard/settings/add-hotel',[SettingsController::class,'addHotel'])->name('addHotel');
        Route::put('/dashboard/settings/update-hotel/{id}',[SettingsController::class,'updateHotel'])->name('updateHotel');
        Route::get('/dashboard/settings/delete-hotel/{id}', [SettingsController::class,'deleteHotel'])->name('deleteHotel');

        //Currency Settings
        Route::get('dashboard/settings/currency-settings',[SettingsController::class, 'getCurrencies'])->name('getCurrencies');
        Route::post('/dashboard/settings/add-currency',[SettingsController::class,'addCurrency'])->name('addCurrency');
        Route::put('/dashboard/settings/update-currency/{id}',[SettingsController::class,'updateCurrency'])->name('updateCurrency');
        Route::get('/dashboard/settings/delete-currency/{id}', [SettingsController::class,'deleteCurrency'])->name('deleteCurrency');

        //Exchange Rate Settings
        Route::get('dashboard/settings/exchange-rate-settings',[SettingsController::class, 'getRates'])->name('getExchangeRates');
        Route::post('/dashboard/settings/add-rate',[SettingsController::class,'addRate'])->name('addRate');
        Route::put('/dashboard/settings/update-rate/{id}',[SettingsController::class,'updateRate'])->name('updateRate');
        Route::get('/dashboard/settings/delete-rate/{id}', [SettingsController::class,'deleteRate'])->name('deleteRate');

        //Source  Settings
        Route::get('dashboard/settings/source-settings',[SettingsController::class, 'getSource'])->name('getSource');
        Route::post('/dashboard/settings/add-source',[SettingsController::class,'addSource'])->name('addSource');
        Route::put('/dashboard/settings/update-source/{id}',[SettingsController::class,'updateSource'])->name('updateSource');
        Route::get('/dashboard/settings/delete-source/{id}', [SettingsController::class,'deleteSource'])->name('deleteSource');

        //Payment Method   Settings
        Route::get('dashboard/settings/payment-method-settings',[SettingsController::class, 'getPaymentMethod'])->name('getPaymentMethod');
        Route::post('/dashboard/settings/add-payment-method',[SettingsController::class,'addPaymentMethod'])->name('addPaymentMethod');
        Route::put('/dashboard/settings/update-payment-method/{id}',[SettingsController::class,'updatePaymentMethod'])->name('updatePaymentMethod');
        Route::get('/dashboard/settings/delete-payment-method/{id}', [SettingsController::class,'deletePaymentMethod'])->name('deletePaymentMethod');


        //Payment Method   Settings
        Route::get('dashboard/settings/reservation-status-settings',[SettingsController::class, 'getReservationStatus'])->name('getReservationStatus');
        Route::post('/dashboard/settings/add-reservation-status',[SettingsController::class,'addReservationStatus'])->name('addReservationStatus');
        Route::put('/dashboard/settings/update-reservation-status/{id}',[SettingsController::class,'updateReservationStatus'])->name('updateReservationStatus');
        Route::get('/dashboard/settings/delete-reservation-status/{id}', [SettingsController::class,'deleteReservationStatus'])->name('deleteReservationStatus');
    });
