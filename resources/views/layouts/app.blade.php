<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudangku - Sistem Inventaris</title>
    <!-- Menggunakan Tailwind CSS via CDN untuk tampilan cepat -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between items-center shadow-md">
        <div class="font-bold text-xl tracking-wide">📦 Gudangku</div>
        
        <!-- Menu Navigasi (Hanya muncul jika sudah login) -->
        @auth
        <div class="flex space-x-4 items-center">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('categories.index') }}" class="hover:underline">Kategori</a>
            <a href="{{ route('products.index') }}" class="hover:underline">Produk</a>
            <a href="{{ route('transactions.index') }}" class="hover:underline">Transaksi</a>
        </div>
        <div>
            <span class="mr-4 font-semibold">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded transition">Logout</button>
            </form>
        </div>
        @endauth
    </nav>

    <!-- Konten Utama -->
    <div class="max-w-6xl mx-auto mt-8 p-4">
        <!-- Notifikasi Sukses (warna hijau) -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Notifikasi Error (warna merah) -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tempat konten dari file lain akan dimasukkan -->
        <div class="bg-white shadow-md rounded-lg p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>