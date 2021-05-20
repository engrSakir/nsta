<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\SuperAdmin;

Route::group(['middleware' => 'superadmin', 'as' => 'superadmin.', 'prefix' => 'backend/super-admin/'], function (){

        Route::get('/dashboard', [SuperAdmin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/banner', [SuperAdmin\BannerController::class, 'index'])->name('banner');
        Route::post('/banner/update', [SuperAdmin\BannerController::class, 'update'])->name('bannerUpdate');
        Route::post('/banner/update-banner-image', [SuperAdmin\BannerController::class, 'bannerImageUpdate'])->name('bannerImageUpdate');

        Route::get('/about', [SuperAdmin\AboutController::class, 'index'])->name('about');
        Route::post('/about/update', [SuperAdmin\AboutController::class, 'update'])->name('aboutUpdate');

        Route::get('/strength-page', [SuperAdmin\StrengthController::class, 'strength'])->name('strength');
        Route::post('/strength/update', [SuperAdmin\StrengthController::class, 'strengthUpdate'])->name('strengthUpdate');

        Route::get('/service-page', [SuperAdmin\ServiceController::class, 'service'])->name('service');
        Route::post('/service/update', [SuperAdmin\ServiceController::class, 'serviceUpdate'])->name('serviceUpdate');

        Route::get('/portfolio-page', [SuperAdmin\PortfolioController::class, 'portfolio'])->name('portfolio');
        Route::post('/portfolio/update', [SuperAdmin\PortfolioController::class, 'portfolioUpdate'])->name('portfolioUpdate');
        Route::patch('/portfolio/add-image/{portfolio}', [SuperAdmin\PortfolioController::class, 'addPortfolioImages'])->name('addPortfolioImages');
        Route::post('/portfolio/remove-image', [SuperAdmin\PortfolioController::class, 'removePortfolioImages'])->name('removePortfolioImages');
        Route::post('/portfolio/images', [SuperAdmin\PortfolioController::class, 'getPortfolioImages'])->name('getPortfolioImages');

        Route::get('/team-page', [SuperAdmin\TeamController::class, 'team'])->name('team');
        Route::post('/team/update', [SuperAdmin\TeamController::class, 'teamUpdate'])->name('teamUpdate');

        Route::get('/price-page', [SuperAdmin\PriceController::class, 'price'])->name('price');
        Route::post('/price/update', [SuperAdmin\PriceController::class, 'priceUpdate'])->name('priceUpdate');

        Route::get('/faq-page', [SuperAdmin\FaqController::class, 'faq'])->name('faq');
        Route::post('/faq/update', [SuperAdmin\FaqController::class, 'faqUpdate'])->name('faqUpdate');

        Route::post('/message/update', [SuperAdmin\WebsiteMessageController::class, 'messageUpdate'])->name('messageUpdate');
        Route::post('/subscriber/update', [SuperAdmin\SubscriberController::class, 'subscriberUpdate'])->name('subscriberUpdate');

        Route::get('/subscriber/email', [SuperAdmin\SubscriberController::class, 'subscriberEmail'])->name('subscriberEmail');
        Route::post('/subscriber/email', [SuperAdmin\SubscriberController::class, 'subscriberEmailSend'])->name('subscriberEmailSend');


        Route::post('/message-status-change', [SuperAdmin\WebsiteMessageController::class, 'messageStatusChange'])->name('messageStatusChange');
        Route::post('/message-reply-mail', [SuperAdmin\WebsiteMessageController::class, 'websiteMessageReplyMail'])->name('websiteMessageReplyMail');

        Route::resource('homeContent', SuperAdmin\HomeContentController::class);
        Route::resource('homeContentFaq', SuperAdmin\HomeContentFaqController::class);
        Route::resource('strength', SuperAdmin\StrengthController::class);
        Route::resource('service', SuperAdmin\ServiceController::class);
        Route::resource('callToAction', SuperAdmin\CallToActionController::class);
        Route::resource('portfolio', SuperAdmin\PortfolioController::class);
        Route::resource('portfolioCategory', SuperAdmin\PortfolioCategoryController::class);
        Route::resource('team', SuperAdmin\TeamController::class);
        Route::resource('price', SuperAdmin\PriceController::class);
        Route::resource('faq', SuperAdmin\FaqController::class);
        Route::resource('blog', SuperAdmin\BlogController::class);
        Route::resource('gallery', SuperAdmin\GalleryController::class);
        Route::resource('partner', SuperAdmin\PartnerController::class);
        Route::resource('testimonial', SuperAdmin\TestimonialController::class);
        Route::resource('customPage', SuperAdmin\CustomPageController::class);
        Route::resource('subscriber', SuperAdmin\SubscriberController::class);
        Route::resource('websiteMessage', SuperAdmin\WebsiteMessageController::class);
        Route::resource('user', SuperAdmin\UserController::class);
        Route::resource('package', SuperAdmin\PackageController::class);
        Route::resource('company', SuperAdmin\CompanyController::class);
        Route::resource('branch', SuperAdmin\BranchController::class);

    });

