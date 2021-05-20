<?php

namespace App\Http\Controllers\Backend\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CallToAction;
use App\Models\Faq;
use App\Models\HomeContent;
use App\Models\Partner;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Price;
use App\Models\Service;
use App\Models\Strength;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\WebsiteMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $partners = Partner::all()->count();
        $home_contents = HomeContent::all()->count();
        $strengths = Strength::all()->count();
        $services = Service::all()->count();
        $faqs = Faq::all()->count();
        $callToActions = CallToAction::all()->count();
        $portfolioCategories = PortfolioCategory::all()->count();
        $portfolios = Portfolio::all()->count();
        $teams = Team::all()->count();
        $prices = Price::all()->count();
        $testimonials = Testimonial::all()->count();
        $users = User::all()->count();
        $messages = WebsiteMessage::all()->count();
        $blogs = Blog::all()->count();

        return view('backend.superadmin.dashboard.index', compact('partners',
            'home_contents',
            'strengths',
            'services',
            'faqs',
            'callToActions',
            'portfolioCategories',
            'teams',
            'prices',
            'users',
            'portfolios',
            'messages',
            'blogs',
            'testimonials'));


    }
}
