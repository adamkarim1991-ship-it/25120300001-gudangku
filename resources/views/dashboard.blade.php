@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Ringkasan Dashboard</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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

<!-- Fitur Peringatan Stok Menipis -->
@if($low_stocks->count() > 0)
<div>
    <h3 class="text-xl font-bold text-red-600 mb-4">⚠️ Peringatan Stok Menipis (Sisa 5 atau kurang)</h3>
    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
        <ul class="list-disc pl-5">
            @foreach($low_stocks as $item)
                <li class="text-red-700 font-semibold mb-1">{{ $item->name }} - Sisa Stok: {{ $item->stock }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- FITUR 6: GRAFIK -->
<div class="mt-8 bg-white p-6 rounded-lg shadow-md border">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Grafik Barang Masuk & Keluar (7 Hari Terakhir)</h3>
    <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const chartData = @json($chart_data);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(item => item.date),
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: chartData.map(item => item.in_qty),
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',
                },
                {
                    label: 'Barang Keluar',
                    data: chartData.map(item => item.out_qty),
                    backgroundColor: 'rgba(239, 68, 68, 0.7)',
                }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
</script>
@endsection