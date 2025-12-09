<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard Pelaku Ekraf</title>

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
                        <span class="text-xl font-bold text-[#E67E22]">Creative</span>
                        <span class="text-xl font-bold text-[#333333] ml-1">Marketplace</span>
                    </a>
                    <button @click="open = false" class="md:hidden text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center px-4 py-3 font-medium text-white bg-[#E67E22] rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" ...><path ...></path></svg>
                        Manajemen Produk
                    </a>

                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center px-4 py-3 font-medium text-gray-700 hover:bg-gray-100 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" ...><path ...></path></svg>
                        Profil Saya
                    </a>
                </nav>
            </aside>

            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b">
                    <button @click="open = true" class="md:hidden text-gray-600 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="ml-auto">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" ...><path ... /></svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
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