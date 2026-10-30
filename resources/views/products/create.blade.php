@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Produk</h2>
<form action="{{ route('products.store') }}" method="POST" class="max-w-lg">
    @csrf
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
        <select name="category_id" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
        <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Stok Awal</label>
        <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        @error('stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <a href="{{ route('products.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Simpan</button>
</form>
@endsection