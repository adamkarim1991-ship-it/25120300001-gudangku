@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4 text-gray-800">Riwayat Perubahan Stok</h2>
<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="py-3 px-4 border-b">Waktu</th>
                <th class="py-3 px-4 border-b">Produk</th>
                <th class="py-3 px-4 border-b">Stok Awal</th>
                <th class="py-3 px-4 border-b">Stok Akhir</th>
                <th class="py-3 px-4 border-b">Keterangan</th>
                <th class="py-3 px-4 border-b">Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr class="hover:bg-gray-50 border-b">
                <td class="py-3 px-4">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td class="py-3 px-4">{{ $log->product->name }}</td>
                <td class="py-3 px-4">{{ $log->qty_before }}</td>
                <td class="py-3 px-4 font-bold">{{ $log->qty_after }}</td>
                <td class="py-3 px-4">{{ $log->note }}</td>
                <td class="py-3 px-4">{{ $log->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection