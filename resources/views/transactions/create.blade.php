@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Catat Transaksi Baru</h2>
<form action="{{ route('transactions.store') }}" method="POST" class="max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Pilih Produk</label>
        <select name="product_id" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
            <option value="">-- Pilih Produk --</option>
            @foreach($products as $prod)
                <option value="{{ $prod->id }}" {{ old('product_id') == $prod->id ? 'selected' : '' }}>
                    {{ $prod->name }} (Stok saat ini: {{ $prod->stock }})
                </option>
            @endforeach
        </select>
        @error('product_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Tipe Transaksi</label>
        <select name="type" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
            <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Barang Masuk (Menambah Stok)</option>
            <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Barang Keluar (Mengurangi Stok)</option>
        </select>
        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Jumlah (Qty)</label>
        <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <a href="{{ route('transactions.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan Transaksi</button>
</form>
@endsection