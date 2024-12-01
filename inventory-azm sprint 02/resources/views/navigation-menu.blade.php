<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Tambahkan Menu Kategori -->
                    <x-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
                        {{ __('Kategori') }}
                    </x-nav-link>

                    <!-- Tambahkan Menu Produk -->
                    <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')">
                        {{ __('Produk') }}
                    </x-nav-link>

                    <!-- Tambahkan Menu Stok -->
                    <x-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.*')">
                        {{ __('Stok') }}
                    </x-nav-link>

                    <!-- Tambahkan Menu Notifikasi -->
                    <div class="relative">
                        <x-nav-link href="{{ route('notifications.index') }}" :active="request()->routeIs('notifications.*')" class="inline-flex items-center">
                            <span>{{ __('Notifikasi') }}</span>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute -top-2 -right-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </x-nav-link>
                    </div>

                    <!-- Tambahkan Menu Laporan -->
                    <x-nav-link href="{{ route('reports.index') }}" :active="request()->routeIs('reports.*')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Responsive Menu Kategori -->
            <x-responsive-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
                {{ __('Kategori') }}
            </x-responsive-nav-link>

            <!-- Responsive Menu Produk -->
            <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.*')">
                {{ __('Produk') }}
            </x-responsive-nav-link>

            <!-- Responsive Menu Stok -->
            <x-responsive-nav-link href="{{ route('stock.index') }}" :active="request()->routeIs('stock.*')">
                {{ __('Stok') }}
            </x-responsive-nav-link>

            <!-- Responsive Menu Notifikasi -->
            <x-responsive-nav-link href="{{ route('notifications.index') }}" :active="request()->routeIs('notifications.*')">
                {{ __('Notifikasi') }}
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <span class="text-red-500">
                        {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                @endif
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>