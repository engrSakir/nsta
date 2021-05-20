<?php

use App\Http\Controllers\Backend\Superadmin;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'super-admin', 'as' => 'application.', 'prefix' => 'application/'], function (){
    Route::group(['as' => 'image.', 'prefix' => 'image/'], function (){
        Route::post('/no-image', [SuperAdmin\SettingController::class, 'noImage'])->name('noImage');
        Route::post('/fav-icon', [SuperAdmin\SettingController::class, 'favIcon'])->name('favIcon');
        Route::post('/backend-logo', [SuperAdmin\SettingController::class, 'backendLogo'])->name('backendLogo');
        Route::post('/frontend-logo', [SuperAdmin\SettingController::class, 'frontendLogo'])->name('frontendLogo');
        Route::post('/backend-light-logo', [SuperAdmin\SettingController::class, 'backendLightLogo'])->name('backendLightLogo');
        Route::post('/backend-text-logo', [SuperAdmin\SettingController::class, 'backendTextLogo'])->name('backendTextLogo');
        Route::post('/backend-text-light-logo', [SuperAdmin\SettingController::class, 'backendTextLightLogo'])->name('backendTextLightLogo');
        Route::post('/breadcrumb-image', [SuperAdmin\SettingController::class, 'breadcrumbImage'])->name('breadcrumbImage');
    });

    Route::group(['as' => 'clear.', 'prefix' => 'clear/'], function (){
        Route::get('/cache_clear', [SuperAdmin\SettingController::class, 'cache_clear'])->name('cache');
        Route::get('/route_clear', [SuperAdmin\SettingController::class, 'route_clear'])->name('route');
        Route::get('/config_clear', [SuperAdmin\SettingController::class, 'config_clear'])->name('config');
        Route::get('/view_clear', [SuperAdmin\SettingController::class, 'view_clear'])->name('view');
    });

    Route::get('/seo-static-option-form', [SuperAdmin\SettingController::class, 'seoStaticOptionForm'])->name('seoStaticOptionForm');
    Route::get('/app-static-form', [SuperAdmin\SettingController::class, 'appStaticForm'])->name('appStaticForm');
    Route::get('/logo-and-image-static-option-form', [SuperAdmin\SettingController::class, 'logoAndImageStaticOptionForm'])->name('logoAndImageStaticOptionForm');
    Route::get('/social-static-option-form', [SuperAdmin\SettingController::class, 'socialStaticOptionForm'])->name('socialStaticOptionForm');
    Route::get('/company-detail-static-option-form', [SuperAdmin\SettingController::class, 'companyDetailStaticOptionForm'])->name('companyDetailStaticOptionForm');
    Route::get('/custom-script-static-option-form', [SuperAdmin\SettingController::class, 'customScriptStaticOptionForm'])->name('customScriptStaticOptionForm');
    Route::get('/fb-page-static-option-form', [SuperAdmin\SettingController::class, 'fbPageStaticOptionForm'])->name('fbPageStaticOptionForm');
    Route::get('/map-link-static-option-form', [SuperAdmin\SettingController::class, 'mapLinkStaticOptionForm'])->name('mapLinkStaticOptionForm');
    Route::get('/footer-credit-static-option-form', [SuperAdmin\SettingController::class, 'footerCreditStaticOptionForm'])->name('footerCreditStaticOptionForm');



    Route::post('/app-static-option-update', [SuperAdmin\SettingController::class, 'appStaticOptionUpdate'])->name('appStaticOptionUpdate');
    Route::post('/seo-static-option-update', [SuperAdmin\SettingController::class, 'seoStaticOptionUpdate'])->name('seoStaticOptionUpdate');
    Route::post('/social-static-option-update', [SuperAdmin\SettingController::class, 'socialStaticOptionUpdate'])->name('socialStaticOptionUpdate');
    Route::post('/company-detail-static-option-update', [SuperAdmin\SettingController::class, 'companyDetailStaticOptionUpdate'])->name('companyDetailStaticOptionUpdate');
    Route::post('/custom-script-static-option-update', [SuperAdmin\SettingController::class, 'customScriptStaticOptionUpdate'])->name('customScriptStaticOptionUpdate');
    Route::post('/fb-page-static-option-update', [SuperAdmin\SettingController::class, 'fbPageStaticOptionUpdate'])->name('fbPageStaticOptionUpdate');
    Route::post('/map-link-static-option-update', [SuperAdmin\SettingController::class, 'mapLinkStaticOptionUpdate'])->name('mapLinkStaticOptionUpdate');
    Route::post('/footer-credit-static-option-update', [SuperAdmin\SettingController::class, 'footerCreditStaticOptionUpdate'])->name('footerCreditStaticOptionUpdate');
});

