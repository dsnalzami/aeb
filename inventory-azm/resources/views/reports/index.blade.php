<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Laporan Stok -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Laporan Stok</h3>
                    <p class="text-gray-600 mb-4">Lihat laporan stok keseluruhan produk</p>
                    <div class="space-x-2">
                        <a href="{{ route('reports.stock') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Lihat
                        </a>
                        <a href="{{ route('reports.stock', ['type' => 'pdf']) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                            PDF
                        </a>
                    </div>
                </div>

                <!-- Laporan Pergerakan -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Laporan Pergerakan</h3>
                    <p class="text-gray-600 mb-4">Lihat laporan pergerakan stok masuk dan keluar</p>
                    <div class="space-x-2">
                        <a href="{{ route('reports.movement') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Lihat
                        </a>
                        <a href="{{ route('reports.movement', ['type' => 'pdf']) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                            PDF
                        </a>
                    </div>
                </div>

                <!-- Laporan Stok Menipis -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Laporan Stok Menipis</h3>
                    <p class="text-gray-600 mb-4">Lihat produk dengan stok di bawah minimum</p>
                    <div class="space-x-2">
                        <a href="{{ route('reports.low-stock') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Lihat
                        </a>
                        <a href="{{ route('reports.low-stock', ['type' => 'pdf']) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                            PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 