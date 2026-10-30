@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h2>
    <a href="{{ route('transactions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">+ Catat Transaksi</a>
</div>
<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="py-3 px-4 border-b">No</th>
                <th class="py-3 px-4 border-b">Tanggal</th>
                <th class="py-3 px-4 border-b">Nama Produk</th>
                <th class="py-3 px-4 border-b">Tipe</th>
                <th class="py-3 px-4 border-b">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
            <tr class="hover:bg-gray-50 border-b">
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">{{ $trx->created_at->format('d M Y - H:i') }}</td>
                <td class="py-3 px-4">{{ $trx->product->name }}</td>
                <td class="py-3 px-4">
                    @if($trx->type == 'in')
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-semibold">MASUK</span>
                    @else
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-semibold">KELUAR</span>
                    @endif
                </td>
                <td class="py-3 px-4 font-bold">{{ $trx->quantity }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4 text-gray-500">Belum ada transaksi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection