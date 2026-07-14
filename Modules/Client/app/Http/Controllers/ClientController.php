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
use Modules\SectionContent\Models\SectionContent;

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

        $about = AboutUs::getContent()->load('primaryPhoto', 'secondaryPhoto');
        $aboutInterior = AboutGallery::category('interior')->orderBy('order')->get();
        $allAboutGalleries = AboutGallery::orderBy('order')->take(9)->get();
        $totalGalleryCount = AboutGallery::count();

        $testimonials = Testimonial::active()->ordered()->get();
        $testimonialPages = $testimonials->chunk(3);

        $faqs = Faq::active()->ordered()->get();

        $setting = RestaurantSetting::getContent();

        $sections = SectionContent::all()->keyBy('section_key');

        return view('client::home', compact('featuredMenus', 'heroMenus', 'events', 'banners', 'about', 'aboutInterior', 'allAboutGalleries', 'totalGalleryCount', 'testimonials', 'testimonialPages', 'faqs', 'setting', 'sections'));
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
     * Menu page — all menus grouped by category, ordered vertically
     */
    public function menu()
    {
        $categories = \Modules\Menu\Models\Category::whereHas('menus', function ($q) {
                $q->where('is_available', true);
            })
            ->with(['menus' => function ($q) {
                $q->where('is_available', true)->orderBy('name');
            }])
            ->orderBy('order')
            ->get();

        return view('client::menu', compact('categories'));
    }

    /**
     * Events page — with optional filter (all / ongoing / upcoming)
     */
    public function events(\Illuminate\Http\Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Event::query()->latest();

        if ($filter === 'ongoing') {
            $query->where('status', 'active')
                  ->where('start_date', '<=', now()->toDateString())
                  ->where('end_date', '>=', now()->toDateString());
        } elseif ($filter === 'upcoming') {
            $query->where('status', 'active')
                  ->where('start_date', '>', now()->toDateString());
        }
        // 'all' shows everything

        $events = $query->paginate(6)->appends(['filter' => $filter]);

        // Representative ramen photo for CTA banner background
        $ctaMenuImage = Menu::where('is_available', true)
            ->whereNotNull('image')
            ->orderBy('price', 'desc')
            ->value('image');

        return view('client::events', compact('events', 'filter', 'ctaMenuImage'));
    }

    /**
     * Event detail page
     */
    public function eventShow(int $id)
    {
        $event = Event::findOrFail($id);

        // Other active events for sidebar / related section
        $otherEvents = Event::active()
            ->where('id', '!=', $event->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('client::events-show', compact('event', 'otherEvents'));
    }
}
