@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold text-gray-800">Data Produk</h2>
    <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">+ Tambah Produk</a>
</div>

<!-- Form Pencarian & Filter -->
<form action="{{ route('products.index') }}" method="GET" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="border p-2 rounded w-1/3">
    <select name="category" class="border p-2 rounded w-1/4">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Cari</button>
    <a href="{{ route('products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</a>
</form>

<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
                <th class="py-3 px-4 border-b">No</th>
                <th class="py-3 px-4 border-b">Gambar</th>
                <th class="py-3 px-4 border-b">Nama Produk</th>
                <th class="py-3 px-4 border-b">Kategori</th>
                <th class="py-3 px-4 border-b">Harga</th>
                <th class="py-3 px-4 border-b">Stok</th>
                <th class="py-3 px-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $prod)
            <tr class="hover:bg-gray-50 border-b">
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">
                    @if($prod->image)
                        <img src="{{ asset('storage/' . $prod->image) }}" alt="Gambar" class="w-16 h-16 object-cover rounded">
                    @else
                        <span class="text-gray-400 text-sm">No Image</span>
                    @endif
                </td>
                <td class="py-3 px-4">{{ $prod->name }}</td>
                <td class="py-3 px-4">{{ $prod->category->name }}</td>
                <td class="py-3 px-4">Rp {{ number_format($prod->price, 0, ',', '.') }}</td>
                <td class="py-3 px-4">
                    <span class="px-2 py-1 {{ $prod->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded text-sm">
                        {{ $prod->stock }}
                    </span>
                </td>
                <td class="py-3 px-4 text-center">
                    <a href="{{ route('products.edit', $prod->id) }}" class="text-blue-500 hover:underline mr-2">Edit</a>
                    <form action="{{ route('products.destroy', $prod->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-4 text-gray-500">Data tidak ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection