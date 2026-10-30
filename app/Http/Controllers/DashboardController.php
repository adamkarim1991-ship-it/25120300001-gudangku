<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $total_products = Product::count();
        $total_categories = Category::count();
        $total_transactions = Transaction::count();
        $low_stocks = Product::where('stock', '<=', 5)->get();

        // FITUR 6: Data untuk Grafik
        $chart_data = Transaction::selectRaw('DATE(created_at) as date, SUM(CASE WHEN type = "out" THEN quantity ELSE 0 END) as out_qty, SUM(CASE WHEN type = "in" THEN quantity ELSE 0 END) as in_qty')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(7)
            ->get();

        return view('dashboard', compact('total_products', 'total_categories', 'total_transactions', 'low_stocks', 'chart_data'));
    }
}