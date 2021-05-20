<?php

use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

    Route::group(['as' => 'backend.', 'prefix' => 'backend/'], function (){
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile-password-update', [ProfileController::class, 'profilePasswordUpdate'])->name('profilePasswordUpdate');
        Route::post('profile-info-update', [ProfileController::class, 'profileInfoUpdate'])->name('profileInfoUpdate');
    });

