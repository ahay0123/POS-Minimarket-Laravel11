<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $now = Carbon::now();

        $applyDateFilter = function ($query) use ($filter, $now) {
            if ($filter == 'today') {
                $query->whereDate('created_at', $now);
            } elseif ($filter == 'week') {
                $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
            } elseif ($filter == 'month') {
                $query->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year);
            }
            return $query;
        };

        $ordersQuery = DB::table('orders');
        $ordersCount = $applyDateFilter(clone $ordersQuery)->count();
        $salesSum = $applyDateFilter(clone $ordersQuery)->sum('total');

        $productsQuery = DB::table('products');
        $productsCount = $applyDateFilter($productsQuery)->count();

        $usersQuery = DB::table('table_user');
        $usersCount = $applyDateFilter($usersQuery)->count();

        $recentOrders = Orders::orderBy('created_at', 'desc')->take(5)->get();

        $stockReminder = DB::table('products')->where('stock', '<', 5)->get();

        return view('dashboard.index', compact('ordersCount', 'productsCount', 'usersCount', 'salesSum', 'filter', 'recentOrders', 'stockReminder'));
    }

    public function chartData(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $now = now();

        $query = DB::table('orders');

        if ($filter == 'today') {
            $query->selectRaw('HOUR(created_at) as label, COUNT(*) as value')
                ->whereDate('created_at', $now)
                ->groupBy(DB::raw('HOUR(created_at)'));
        } else {
            $query->selectRaw('DATE(created_at) as label, COUNT(*) as value');

            if ($filter == 'week') {
                $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
            } elseif ($filter == 'month') {
                $query->whereMonth('created_at', $now->month)
                    ->whereYear('created_at', $now->year);
            }

            $query->groupBy(DB::raw('DATE(created_at)'));
        }

        return response()->json($query->get());
    }
}
