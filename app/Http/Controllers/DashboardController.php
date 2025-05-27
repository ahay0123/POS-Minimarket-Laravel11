<?php

namespace App\Http\Controllers;

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
        $ordersCount = $applyDateFilter($ordersQuery)->count();

        $productsQuery = DB::table('products');
        $productsCount = $applyDateFilter($productsQuery)->count();

        $usersQuery = DB::table('table_user');
        $usersCount = $applyDateFilter($usersQuery)->count();

        return view('dashboard.index', compact('ordersCount', 'productsCount', 'usersCount', 'filter'));
    }
}
