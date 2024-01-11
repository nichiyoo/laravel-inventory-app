<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = [
            'stock' => Asset::sum('stock'),
            'price' => Asset::sum('price'),
        ];

        $count = [
            'assets' => Asset::count(),
            'users' => User::count(),
        ];

        $callout = [
            'all' => Asset::count(),
            'hardware' => Asset::where('category', 'Hardware')->count(),
            'software' => Asset::where('category', 'Software')->count(),
            'peripheral' => Asset::where('category', 'Peripheral')->count(),
        ];

        $assets = Asset::query()
            ->orderBy('price', 'desc')
            ->get()
            ->take(20);

        /* For Chart */

        $price = Asset::selectRaw('DATE(created_at) as date, sum(price) as price')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('price', 'date')
            ->toArray();

        $stock = Asset::selectRaw('DATE(created_at) as date, sum(stock) as stock')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('stock', 'date')
            ->toArray();

        $casset = Asset::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        $cuser = User::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        return view('dashboard.index', [
            'assets' => $assets,
            'total' => $total,
            'count' => $count,
            'callout' => $callout,

            /* For Chart */

            'price' => $price,
            'stock' => $stock,
            'casset' => $casset,
            'cuser' => $cuser,
        ]);
    }
}
