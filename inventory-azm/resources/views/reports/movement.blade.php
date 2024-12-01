<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Pergerakan Stok') }}
            </h2>
            <a href="{{ route('reports.movement', ['type' => 'pdf'] + request()->all()) }}" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                Download PDF
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Filter Form -->
                <form action="{{ route('reports.movement') }}" method="GET" class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Akhir</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipe</label>
                            <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Semua</option>
                                <option value="in" {{ request('type') === 'in' ? 'selected' : '' }}>Masuk</option>
                                <option value="out" {{ request('type') === 'out' ? 'selected' : '' }}>Keluar</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                            Filter
                        </button>
                    </div>
                </form>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($movements as $movement)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $movement->product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $movement->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $movement->type === 'in' ? 'Masuk' : 'Keluar' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $movement->quantity }}</td>
                                <td class="px-6 py-4">{{ $movement->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $movement->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 