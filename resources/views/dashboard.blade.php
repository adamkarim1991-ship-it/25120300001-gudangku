@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Ringkasan Dashboard</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg shadow-sm text-center">
        <h3 class="text-lg font-semibold text-blue-800">Total Produk</h3>
        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $total_products }}</p>
    </div>
    <div class="bg-green-50 border border-green-200 p-6 rounded-lg shadow-sm text-center">
        <h3 class="text-lg font-semibold text-green-800">Total Kategori</h3>
        <p class="text-4xl font-bold text-green-600 mt-2">{{ $total_categories }}</p>
    </div>
    <div class="bg-purple-50 border border-purple-200 p-6 rounded-lg shadow-sm text-center">
        <h3 class="text-lg font-semibold text-purple-800">Total Transaksi</h3>
        <p class="text-4xl font-bold text-purple-600 mt-2">{{ $total_transactions }}</p>
    </div>
</div>
@endsection