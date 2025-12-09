<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Majalengka Creative Center</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-900 text-white">

        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            
            <<div class="absolute inset-0 z-0">
                <img src="{{ asset('images/MCC.jpg') }}" alt="MCC Background" class="w-full h-full object-cover scale-105 animate-slow-zoom">
                
                <div class="absolute inset-0 bg-black/40 from-black/90 via-transparent to-transparent"></div>
            </div>

            <div class="absolute top-0 left-0 w-full p-6 z-50 flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-[#E67E22] rounded-full flex items-center justify-center text-white font-bold text-xl shadow-xl group-hover:scale-110 transition-transform">M</div>
                    <span class="text-lg font-bold tracking-tight text-white drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">Creative<span class="text-[#E67E22]">Center</span></span>
                </a>

                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-sm font-bold text-white border-2 border-white/50 bg-black/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition shadow-lg">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-white bg-[#E67E22] rounded-full shadow-xl hover:bg-[#D35400] transition transform hover:-translate-y-1 border border-white/20">
                            Login Pelaku Ekraf
                        </a>
                    @endauth
                </div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center transform -translate-y-8">
                
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-black/30 border border-white/30 text-white text-xs font-semibold tracking-wide uppercase mb-8 backdrop-blur-md shadow-lg">
                    <span class="w-2 h-2 bg-[#E67E22] rounded-full mr-2 animate-pulse"></span>
                    Platform Resmi Ekraf Majalengka
                </div>
                
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight drop-shadow-[0_4px_4px_rgba(0,0,0,0.8)]">
                    Temukan Karya <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E67E22] via-orange-400 to-yellow-500 drop-shadow-sm">Kreatif & Unik</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white mb-10 leading-relaxed max-w-2xl mx-auto drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)] font-medium">
                    Jelajahi koleksi produk kreatif berkualitas dari para pelaku ekonomi kreatif Majalengka. Temukan karya tangan asli Majalengka yang penuh cerita dan makna.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-5 justify-center">
                    <a href="{{ route('catalog.index') }}" class="inline-flex justify-center items-center px-8 py-4 text-lg font-bold text-white bg-[#E67E22] rounded-full hover:bg-[#D35400] transition transform hover:-translate-y-1 shadow-2xl border border-white/20">
                        Jelajahi Katalog
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>

            </div>
        </section>

        <footer class="bg-white text-gray-900 border-t border-gray-100 pt-16 pb-8 relative z-20">
            <div class="max-w-[1400px] mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                    
                    <div class="col-span-1 md:col-span-2">
                        <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-black text-white rounded-full flex items-center justify-center font-bold text-lg">M</div>
                            <div class="flex flex-col">
                                <span class="font-bold text-sm tracking-tight leading-none">Creative</span>
                                <span class="font-bold text-sm tracking-tight leading-none text-[#E67E22]">Center</span>
                            </div>
                        </a>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
                            Wadah kolaborasi dan pemasaran produk ekonomi kreatif unggulan Kabupaten Majalengka. Dukung lokal, bangga buatan Indonesia.
                        </p>
                    </div>
        
                    <div>
                        <h4 class="font-bold text-gray-900 mb-6 text-sm uppercase tracking-wider">Eksplorasi</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li><a href="{{ url('/') }}" class="hover:text-[#E67E22] transition">Beranda</a></li>
                            <li><a href="{{ route('catalog.index') }}" class="hover:text-[#E67E22] transition">Katalog Produk</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-[#E67E22] transition">Login Pelaku Ekraf</a></li>
                        </ul>
                    </div>
        
                    <div>
                        <h4 class="font-bold text-gray-900 mb-6 text-sm uppercase tracking-wider">Hubungi Kami</h4>
                        <ul class="space-y-4 text-sm text-gray-500">
                            <li>Majalengka, Jawa Barat</li>
                            <li>info@mcc-majalengka.id</li>
                            <li class="flex gap-4 mt-4">
                                <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#E67E22] hover:text-white transition">IG</a>
                                <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-[#E67E22] hover:text-white transition">WA</a>
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

        <style>
            .animate-slow-zoom {
                animation: slowZoom 20s infinite alternate ease-in-out;
            }
            @keyframes slowZoom {
                from { transform: scale(1.05); }
                to { transform: scale(1.15); }
            }
        </style>

        @livewireScripts
    </body>
</html>