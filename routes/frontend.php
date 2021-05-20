<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'frontend.'], function (){
Route::get('/', [FrontendController::class, 'index']);

Route::get('/gallery', [FrontendController::class, 'gallery']);

Route::get('/blogs', [FrontendController::class, 'blogs']);
Route::get('/blog/{blog}', [FrontendController::class, 'blogDetail']);

Route::get('/page/{slug}', [FrontendController::class, 'page']);
Route::get('/portfolio/{slug}', [FrontendController::class, 'portfolio']);

Route::post('/contact-message-store', [FrontendController::class, 'contactMessageStore']);
Route::post('/subscribe/store', [FrontendController::class, 'subscribeStore']);

Route::post('/company/store', [FrontendController::class, 'companyRegistration'])->name('companyRegistration');
});
