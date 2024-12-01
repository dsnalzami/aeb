<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Notifikasi') }}
            </h2>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($notifications->isEmpty())
                    <p class="text-gray-500 text-center py-4">Tidak ada notifikasi</p>
                @else
                    <div class="space-y-4">
                        @foreach($notifications as $notification)
                            <div class="flex items-center justify-between p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-yellow-50' }} rounded-lg">
                                <div class="flex-1">
                                    <p class="text-gray-800">{{ $notification->data['message'] }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                @if(!$notification->read_at)
                                    <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-800">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 