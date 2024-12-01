<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Laporan Stok -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Laporan Stok</h4>
                        <div class="space-x-2">
                            <a href="{{ route('reports.stock') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                Lihat
                            </a>
                            <a href="{{ route('reports.stock', ['type' => 'pdf']) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                                PDF
                            </a>
                        </div>
                    </div>

                    <!-- Laporan Pergerakan Stok -->
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Laporan Pergerakan Stok</h4>
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
                    <div class="border rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Laporan Stok Menipis</h4>
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
    </div>
</x-app-layout> 