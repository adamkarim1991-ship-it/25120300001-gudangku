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
        
        return view('dashboard', compact('total_products', 'total_categories', 'total_transactions'));
    }
}