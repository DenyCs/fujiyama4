<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Menu\Models\Menu;
use Modules\Order\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = now()->toDateString();

        $orderCount = Order::whereDate('created_at', $today)->count();
        $revenueToday = Order::whereDate('created_at', $today)
            ->where('status', '!=', 'batal')
            ->sum('total_price');
        $menuCount = Menu::where('is_available', true)->count();

        return view('admin::dashboard', compact('orderCount', 'revenueToday', 'menuCount'));
    }
}
