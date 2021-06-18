<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Customer;

Route::group(['middleware' => 'customer', 'as' => 'customer.', 'prefix' => ''], function (){

    Route::get('/dashboard', [Customer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/show/{invoice}', [Customer\DashboardController::class, 'invoiceShow'])->name('invoice.show');
    Route::get('/download/{invoice}', [Customer\DashboardController::class, 'invoiceDownload'])->name('invoice.download');


});

