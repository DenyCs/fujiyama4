<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\About\Models\AboutGallery;
use Modules\About\Models\AboutUs;
use Modules\Banner\Models\Banner;
use Modules\Event\Models\Event;
use Modules\Menu\Models\Menu;
use Modules\Testimonial\Models\Testimonial;
use Modules\Faq\Models\Faq;
use Modules\Setting\Models\RestaurantSetting;

class ClientController extends Controller
{
    /**
     * Landing page / Home
     */
    public function home()
    {
        $featuredMenus = Menu::where('is_available', true)
            ->with('category')
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $heroMenus = Menu::where('is_available', true)
            ->with('category')
            ->latest()
            ->limit(3)
            ->get();

        $events = Event::active()->latest()->get();

        $banners = Banner::active()->orderBy('order')->get();

        $about = AboutUs::getContent();
        $aboutInterior = AboutGallery::category('interior')->orderBy('order')->get();
        $allAboutGalleries = AboutGallery::orderBy('order')->take(9)->get();
        $totalGalleryCount = AboutGallery::count();

        $testimonials = Testimonial::active()->ordered()->get();
        $testimonialPages = $testimonials->chunk(3);

        $faqs = Faq::active()->ordered()->get();

        $setting = RestaurantSetting::getContent();

        return view('client::home', compact('featuredMenus', 'heroMenus', 'events', 'banners', 'about', 'aboutInterior', 'allAboutGalleries', 'totalGalleryCount', 'testimonials', 'testimonialPages', 'faqs', 'setting'));
    }

    /**
     * Full gallery page — all photos, no limit
     */
    public function gallery()
    {
        $allAboutGalleries = AboutGallery::orderBy('order')->get();

        return view('client::gallery', compact('allAboutGalleries'));
    }

    /**
     * Menu page — all menus grouped by category
     */
    public function menu()
    {
        $menus = Menu::where('is_available', true)
            ->with('category')
            ->orderBy('name')
            ->get();

        return view('client::menu', compact('menus'));
    }

    /**
     * Events page
     */
    public function events()
    {
        $events = Event::active()->latest()->paginate(6);
        return view('client::events', compact('events'));
    }
}