<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin;


Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'backend/admin/'], function (){

    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/package', [Admin\PackageController::class, 'index'])->name('package');
    Route::get('/company', [Admin\CompanyController::class, 'index'])->name('company.index');
    Route::post('/company', [Admin\CompanyController::class, 'update'])->name('company.update');

    Route::resource('branch', Admin\BranchController::class);
    Route::resource('manager', Admin\ManagerController::class);

    //Website (Super access)
    Route::get('/banner', [Admin\BannerController::class, 'index'])->name('banner');
    Route::post('/banner/update', [Admin\BannerController::class, 'update'])->name('bannerUpdate');
    Route::post('/banner/update-banner-image', [Admin\BannerController::class, 'bannerImageUpdate'])->name('bannerImageUpdate');

    Route::get('/about', [Admin\AboutController::class, 'index'])->name('about');
    Route::post('/about/update', [Admin\AboutController::class, 'update'])->name('aboutUpdate');

    Route::get('/strength-page', [Admin\StrengthController::class, 'strength'])->name('strength');
    Route::post('/strength/update', [Admin\StrengthController::class, 'strengthUpdate'])->name('strengthUpdate');

    Route::get('/service-page', [Admin\ServiceController::class, 'service'])->name('service');
    Route::post('/service/update', [Admin\ServiceController::class, 'serviceUpdate'])->name('serviceUpdate');

    Route::get('/portfolio-page', [Admin\PortfolioController::class, 'portfolio'])->name('portfolio');
    Route::post('/portfolio/update', [Admin\PortfolioController::class, 'portfolioUpdate'])->name('portfolioUpdate');
    Route::patch('/portfolio/add-image/{portfolio}', [Admin\PortfolioController::class, 'addPortfolioImages'])->name('addPortfolioImages');
    Route::post('/portfolio/remove-image', [Admin\PortfolioController::class, 'removePortfolioImages'])->name('removePortfolioImages');
    Route::post('/portfolio/images', [Admin\PortfolioController::class, 'getPortfolioImages'])->name('getPortfolioImages');

    Route::get('/team-page', [Admin\TeamController::class, 'team'])->name('team');
    Route::post('/team/update', [Admin\TeamController::class, 'teamUpdate'])->name('teamUpdate');

    Route::get('/price-page', [Admin\PriceController::class, 'price'])->name('price');
    Route::post('/price/update', [Admin\PriceController::class, 'priceUpdate'])->name('priceUpdate');

    Route::get('/faq-page', [Admin\FaqController::class, 'faq'])->name('faq');
    Route::post('/faq/update', [Admin\FaqController::class, 'faqUpdate'])->name('faqUpdate');

    Route::post('/message/update', [Admin\WebsiteMessageController::class, 'messageUpdate'])->name('messageUpdate');
    Route::post('/subscriber/update', [Admin\SubscriberController::class, 'subscriberUpdate'])->name('subscriberUpdate');

    Route::get('/subscriber/email', [Admin\SubscriberController::class, 'subscriberEmail'])->name('subscriberEmail');
    Route::post('/subscriber/email', [Admin\SubscriberController::class, 'subscriberEmailSend'])->name('subscriberEmailSend');


    Route::post('/message-status-change', [Admin\WebsiteMessageController::class, 'messageStatusChange'])->name('messageStatusChange');
    Route::post('/message-reply-mail', [Admin\WebsiteMessageController::class, 'websiteMessageReplyMail'])->name('websiteMessageReplyMail');

    Route::resource('homeContent', Admin\HomeContentController::class);
    Route::resource('homeContentFaq', Admin\HomeContentFaqController::class);
    Route::resource('strength', Admin\StrengthController::class);
    Route::resource('service', Admin\ServiceController::class);
    Route::resource('callToAction', Admin\CallToActionController::class);
    Route::resource('portfolio', Admin\PortfolioController::class);
    Route::resource('portfolioCategory', Admin\PortfolioCategoryController::class);
    Route::resource('team', Admin\TeamController::class);
    Route::resource('price', Admin\PriceController::class);
    Route::resource('faq', Admin\FaqController::class);
    Route::resource('blog', Admin\BlogController::class);
    Route::resource('gallery', Admin\GalleryController::class);
    Route::resource('partner', Admin\PartnerController::class);
    Route::resource('testimonial', Admin\TestimonialController::class);
    Route::resource('customPage', Admin\CustomPageController::class);
    Route::resource('subscriber', Admin\SubscriberController::class);
    Route::resource('websiteMessage', Admin\WebsiteMessageController::class);
    //Website (Super access)
});

