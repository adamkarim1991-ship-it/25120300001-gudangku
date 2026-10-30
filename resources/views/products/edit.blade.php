@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Produk</h2>
<form action="{{ route('products.update', $product->id) }}" method="POST" class="max-w-lg">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
        <select name="category_id" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Harga (Rp)</label>
        <input type="number" name="price" value="{{ $product->price }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Stok</label>
        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
    </div>
    <a href="{{ route('products.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Update</button>
</form>
@endsection