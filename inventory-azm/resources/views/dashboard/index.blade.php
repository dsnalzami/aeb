<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistik -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Total Products -->
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Total Produk</h3>
                        <p class="text-3xl font-bold">{{ $totalProducts }}</p>
                    </div>

                    <!-- Total Categories -->
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Total Kategori</h3>
                        <p class="text-3xl font-bold">{{ $totalCategories }}</p>
                    </div>

                    <!-- Low Stock Alert -->
                    <div class="bg-red-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Stok Menipis</h3>
                        <p class="text-3xl font-bold">{{ $lowStockProducts }}</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Cepat -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Kategori -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Manajemen Kategori</h4>
                        <div class="space-x-2">
                            <a href="{{ route('categories.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Lihat Kategori
                            </a>
                            <a href="{{ route('categories.create') }}" class="inline-block bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                Tambah Kategori
                            </a>
                        </div>
                    </div>

                    <!-- Produk -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Manajemen Produk</h4>
                        <div class="space-x-2">
                            <a href="{{ route('products.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Lihat Produk
                            </a>
                            <a href="{{ route('products.create') }}" class="inline-block bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                Tambah Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 