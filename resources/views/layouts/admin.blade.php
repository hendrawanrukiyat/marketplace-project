<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Dashboard - MCC</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div x-data="{ open: true }" class="flex h-screen bg-gray-100">
            <aside 
                :class="{ 'translate-x-0': open, '-translate-x-full': !open }" 
                class="fixed inset-y-0 left-0 z-30 w-64 px-4 py-7 overflow-y-auto bg-white border-r transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0">

                <div class="flex items-center justify-between px-2 mb-6">
                    <a href="{{ url('/') }}" class="flex items-baseline">
                        <span class="text-xl font-bold text-gray-800">Admin</span>
                        <span class="text-xl font-bold text-[#E67E22] ml-1">Panel</span>
                    </a>
                </div>

                <nav class="space-y-2">
    <a href="{{ route('admin.dashboard') }}" 
       class="flex items-center px-4 py-3 font-medium {{ request()->routeIs('admin.dashboard') ? 'text-white bg-[#E67E22]' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
        Dashboard
    </a>
    
    <a href="{{ route('admin.products') }}" 
       class="flex items-center px-4 py-3 font-medium {{ request()->routeIs('admin.products') ? 'text-white bg-[#E67E22]' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        Semua Produk
    </a>

    <a href="{{ route('admin.sellers') }}" 
       class="flex items-center px-4 py-3 font-medium {{ request()->routeIs('admin.sellers') ? 'text-white bg-[#E67E22]' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        Pelaku Ekraf
    </a>
</nav>

            </aside>

            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b">
                    <button @click="open = true" class="md:hidden ...">
                        </button>

                    <div class="ml-auto">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center ...">
                                    <div>{{ Auth::user()->name }}</div> <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" ...><path ... /></svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @livewireScripts
    </body>
</html>