<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Top 5 menus sold in last 7 days
        $sevenDaysAgo = Carbon::now()->subDays(7)->startOfDay();
        $topMenus = OrderItem::select(
                'menu_id',
                'menu_name',
                DB::raw('SUM(qty) as total_qty')
            )
            ->whereHas('order', function ($q) use ($sevenDaysAgo) {
                $q->where('created_at', '>=', $sevenDaysAgo)
                  ->where('status', '!=', 'batal');
            })
            ->groupBy('menu_id', 'menu_name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        // Revenue per day for last 7 days (for chart)
        $revenueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $endOfDay = $date->copy()->endOfDay();

            $total = Order::whereBetween('created_at', [$date, $endOfDay])
                ->where('status', '!=', 'batal')
                ->sum('total_price');

            $revenueData[] = [
                'date' => $date->translatedFormat('D j M'),
                'raw_date' => $date->toDateString(),
                'total' => (int) $total,
            ];
        }

        return view('admin::dashboard', compact(
            'topMenus',
            'revenueData'
        ));
    }
}