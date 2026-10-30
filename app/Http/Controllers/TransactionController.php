<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index() 
    { 
        $transactions = Transaction::with('product')->latest()->get(); 
        return view('transactions.index', compact('transactions')); 
    }
    
    public function create() 
    { 
        $products = Product::all(); 
        return view('transactions.create', compact('products')); 
    }
    
    public function store(Request $request) 
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);
        
        if ($request->type == 'out' && $product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi!'])->withInput();
        }

        Transaction::create($request->all());

        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat');
    }
}