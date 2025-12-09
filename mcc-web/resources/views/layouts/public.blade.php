<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Majalengka Creative Center</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-[#F8F8F8]">

        <div x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-baseline">
                            <span class="text-xl font-bold text-[#E67E22]">Creative</span>
                            <span class="text-xl font-bold text-[#333333] ml-1">Marketplace</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ url('/') }}" class="text-[#333333] hover:text-[#E67E22] transition-colors font-medium">Beranda</a>
                        <a href="{{ route('catalog.index') }}" class="text-[#333333] hover:text-[#E67E22] transition-colors font-medium">Produk</a>
                        <a href="#" class="text-[#333333] hover:text-[#E67E22] transition-colors font-medium">Tentang</a>
                        <a href="#" class="text-[#333333] hover:text-[#E67E22] transition-colors font-medium">Kontak</a>
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 border-l border-gray-300 pl-6 ml-4">
                            Login Pelaku Ekraf
                        </a>
                    </div>
                    <div class="md:hidden flex items-center">
                        <button @click="open = !open" ...>
                            </button>
                    </div>
                </div>
            </nav>
            <div x-show="open" class="md:hidden" style="display: none;">
                </div>
        </div>
        <main>
            {{ $slot }}
        </main>

        @livewireScripts
        

        <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            
            <div class="col-span-1 md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-black text-white rounded-full flex items-center justify-center font-bold text-lg">M</div>
                    <span class="font-bold text-lg tracking-tight">Creative<span class="text-[#E67E22]">Center</span></span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
                    Wadah kolaborasi dan pemasaran produk ekonomi kreatif unggulan Kabupaten Majalengka. Dukung lokal, bangga buatan Indonesia.
                </p>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-6">Eksplorasi</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li><a href="{{ url('/') }}" class="hover:text-[#E67E22] transition">Beranda</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="hover:text-[#E67E22] transition">Katalog Produk</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-[#E67E22] transition">Login Pelaku Ekraf</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-gray-900 mb-6">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li>Majalengka, Jawa Barat</li>
                    <li>info@mcc-majalengka.id</li>
                    <li class="flex gap-4 mt-4">
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#E67E22] hover:text-white transition">
                            IG
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#E67E22] hover:text-white transition">
                            WA
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-400">
                &copy; {{ date('Y') }} Majalengka Creative Center. All rights reserved.
            </p>
            <div class="flex gap-6 text-xs text-gray-400">
                <a href="#" class="hover:text-black">Privacy Policy</a>
                <a href="#" class="hover:text-black">Terms of Service</a>
            </div>
        </div>
    </div>
    </footer>
    </body>
</html>