<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Banner\Models\Banner;
use Modules\Event\Models\Event;
use Modules\Menu\Models\Category;
use Modules\Menu\Models\Menu;

class ClientController extends Controller
{
    /**
     * Landing page / Home
     */
    public function home()
    {
        $categories = Category::with('menus')->get();
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

        $events = Event::active()->latest()->limit(4)->get();

        $banners = Banner::active()->orderBy('order')->get();

        return view('client::home', compact('categories', 'featuredMenus', 'heroMenus', 'events', 'banners'));
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
        $events = Event::active()->latest()->get();
        return view('client::events', compact('events'));
    }
}
