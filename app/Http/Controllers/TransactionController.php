<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\StockLog;
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

        $stokAwal = $product->stock;
        Transaction::create($request->all());

        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
            $stokAkhir = $stokAwal + $request->quantity;
        } else {
            $product->decrement('stock', $request->quantity);
            $stokAkhir = $stokAwal - $request->quantity;
        }

        // FITUR 7: Mencatat log riwayat stok
        StockLog::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'qty_before' => $stokAwal,
            'qty_after' => $stokAkhir,
            'note' => 'Transaksi ' . ($request->type == 'in' ? 'Masuk' : 'Keluar')
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat');
    }

    // FITUR 5: Export PDF
    public function exportPdf()
    {
        $transactions = Transaction::with('product')->latest()->get();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transactions.pdf', compact('transactions'));
        return $pdf->download('laporan-transaksi-gudangku.pdf');
    }

    // FITUR 7: Halaman Riwayat Stok
    public function stockLogs()
    {
        $logs = StockLog::with(['product', 'user'])->latest()->get();
        return view('transactions.logs', compact('logs'));
    }
}