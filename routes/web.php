<?php

use Illuminate\Support\Facades\Route;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

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

require __DIR__.'/frontend.php';
require __DIR__.'/auth.php';

 Route::group(['middleware' => 'auth'], function (){
        require __DIR__.'/application.php';
        require __DIR__.'/superadmin.php';
        require __DIR__.'/admin.php';
        require __DIR__.'/manager.php';
        require __DIR__.'/customer.php';
        require __DIR__.'/backend.php';
 });




 Route::get('/pdf/a4', function (){
    $pdf = PDF::loadView('backend.pdf.a4');
		return $pdf->stream('document.pdf');
 });

Route::get('/pdf/a4-1', function (){
    $pdf = PDF::loadView('backend.pdf.a4-1');
    return $pdf->stream('document.pdf');
});

 Route::get('/pdf/a5', function (){
    $pdf = PDF::loadView('backend.pdf.a5');
		return $pdf->stream('document.pdf');
 });

 Route::get('/pdf/a-5-one', function (){
    $pdf = PDF::loadView('backend.pdf.invoice');
		return $pdf->stream('a-5-one.pdf');
 });

