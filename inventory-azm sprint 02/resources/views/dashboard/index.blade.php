<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Total Produk</h3>
                        <p class="text-2xl">{{ $stats['total_products'] }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Total Kategori</h3>
                        <p class="text-2xl">{{ $stats['total_categories'] }}</p>
                    </div>
                    <div class="bg-red-100 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">Stok Menipis</h3>
                        <p class="text-2xl">{{ $stats['low_stock_count'] }}</p>
                    </div>
                </div>

                <!-- Menu Cepat -->
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

                    <!-- Stok -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Manajemen Stok</h4>
                        <div class="space-x-2">
                            <a href="{{ route('stock.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Lihat Stok
                            </a>
                        </div>
                    </div>

                    <!-- Laporan -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Laporan</h4>
                        <div class="space-x-2">
                            <a href="{{ route('reports.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Lihat Laporan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pergerakan Stok Terakhir -->
                @if($stats['recent_movements']->isNotEmpty())
                <div class="mt-8">
                    <h4 class="font-semibold mb-2">Pergerakan Stok Terakhir</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($stats['recent_movements'] as $movement)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $movement->product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movement->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $movement->type === 'in' ? 'Masuk' : 'Keluar' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $movement->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $movement->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 