@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Kategori</h2>
<form action="{{ route('categories.update', $category->id) }}" method="POST" class="max-w-lg">
    @csrf @method('PUT')
    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
        <input type="text" name="name" value="{{ $category->name }}" class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500" required>
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <a href="{{ route('categories.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</a>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Update</button>
</form>
@endsection