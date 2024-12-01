<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Stok') }}
            </h2>
            <a href="{{ route('reports.stock', ['type' => 'pdf']) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                Download PDF
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Masuk</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Keluar</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($stocks as $stock)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->stock->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->total_in }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $stock->total_out }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 