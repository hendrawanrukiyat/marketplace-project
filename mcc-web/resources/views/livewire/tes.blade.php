<div class="min-h-screen bg-white text-black font-sans selection:bg-orange-100 selection:text-orange-900">
        <style>
    /* Menyembunyikan Navbar bawaan dari Layout Utama */
    body > div:first-of-type {
        display: none !important;
    }
</style>
    
    <style>
        @keyframes float {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: float 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        /* Animasi Masuk (Fade In Up) */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0; /* Mulai dari hilang */
        }
    </style>

    <div class="relative bg-[#FFFCF5] pb-32 pt-10 lg:pt-16 overflow-hidden border-b border-gray-100">
        
        <div class="absolute inset-0" style="background-image: linear-gradient(#E5E7EB 1px, transparent 1px), linear-gradient(to right, #E5E7EB 1px, transparent 1px); background-size: 40px 40px; opacity: 0.4;"></div>
        
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 left-20 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="relative max-w-[1400px] mx-auto px-6 mb-16 flex justify-between items-center z-20">
            <a href="{{ url('/') }}" class="flex items-center gap-2 group cursor-pointer hover:scale-105 transition-transform duration-300">
                <div class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center font-bold text-lg group-hover:bg-[#E67E22] transition-colors shadow-lg">M</div>
                <div class="flex flex-col">
                    <span class="font-bold text-sm tracking-tight leading-none">Creative</span>
                    <span class="font-bold text-sm tracking-tight leading-none text-[#E67E22]">Center</span>
                </div>
            </a>

            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-bold text-black border-2 border-black rounded-full hover:bg-black hover:text-white transition-all duration-300">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2.5 text-sm font-bold text-white bg-[#E67E22] rounded-full shadow-lg shadow-orange-500/30 hover:bg-[#D35400] hover:shadow-orange-500/50 transition-all transform hover:-translate-y-1 hover:scale-105">
                        Login Pelaku Ekraf
                    </a>
                @endauth
            </div>
        </div>

        <div class="relative max-w-[1400px] mx-auto px-6 pb-10 z-10 fade-in-up">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center border-b border-gray-300 pb-12">
                
                <div class="lg:col-span-7">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="h-px w-8 bg-[#E67E22]"></span>
                        <p class="text-xs font-bold text-[#E67E22] uppercase tracking-[0.2em]">Galeri Produk</p>
                    </div>
                    <h1 class="text-5xl md:text-7xl font-serif leading-tight text-gray-900">
                        Temukan karya yang <br>
                        <span class="italic font-light text-transparent bg-clip-text bg-gradient-to-r from-[#E67E22] to-orange-600">berbicara kepada Anda.</span>
                    </h1>
                </div>

                <div class="lg:col-span-5 flex flex-col justify-end h-full">
                    <p class="text-lg text-gray-600 leading-relaxed mb-8">
                        Setiap produk adalah komposisi dari kejelasan, proporsi, dan keheningan. Mencerminkan bahasa abadi dari para kreator Majalengka.
                    </p>
                    
                    <form wire:submit.prevent="$refresh" class="relative group w-full">
                        <input 
                            wire:model.defer="search" 
                            type="text" 
                            class="w-full bg-white border-0 rounded-full py-4 pl-6 pr-14 text-lg text-gray-900 placeholder-gray-400 shadow-xl ring-1 ring-gray-100 focus:ring-2 focus:ring-[#E67E22] transition-all duration-300 transform focus:-translate-y-1" 
                            placeholder="Cari inspirasi..." 
                        >
                        <button type="submit" class="absolute right-2 top-2 p-2 bg-[#E67E22] text-white rounded-full hover:bg-[#D35400] hover:scale-110 transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-10 flex flex-wrap gap-3 justify-center md:justify-start fade-in-up" style="animation-delay: 0.2s;">
                <button wire:click="$set('selectedCategory', '')" 
                        class="px-5 py-2.5 border rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105
                        {{ $selectedCategory == '' ? 'bg-black text-white border-black shadow-lg' : 'bg-transparent text-gray-600 border-gray-300 hover:border-black hover:text-black hover:bg-white' }}">
                    All
                </button>
                @foreach([
                    'Animasi', 'Arsitektur', 'Desain', 'Fotografi', 'Musik', 'Kriya', 
                    'Kuliner', 'Fashion', 'R&D', 'Penerbitan', 'Perfilman', 'Periklanan', 
                    'Game', 'Seni Pertunjukan', 'Seni Rupa', 'TI', 'TV & Radio', 'Video'
                ] as $cat)
                    <button wire:click="$set('selectedCategory', '{{ $cat }}')" 
                            class="px-5 py-2.5 border rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105
                            {{ $selectedCategory == $cat ? 'bg-black text-white border-black shadow-lg' : 'bg-transparent text-gray-600 border-gray-300 hover:border-black hover:text-black hover:bg-white' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-6 pt-12 pb-24 -mt-24 relative z-10 bg-white rounded-t-[3rem] shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($products as $index => $product)
                <div class="group cursor-pointer h-full fade-in-up" style="animation-delay: {{ ($loop->index + 3) * 0.1 }}s">
                    <a href="{{ route('product.detail', $product) }}" class="block h-full flex flex-col border border-gray-200 rounded-xl overflow-hidden hover:border-orange-200 hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-500 bg-white transform hover:-translate-y-2">
                        
                        <div class="relative w-full aspect-[4/5] overflow-hidden bg-gray-100">
                            <img src="{{ asset('storage/' . $product->cover_image_path) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-out">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="mb-4">
                                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1 group-hover:text-orange-500 transition-colors">{{ $product->category }}</p>
                                <h3 class="text-lg font-serif font-medium text-gray-900 group-hover:text-[#E67E22] transition-colors leading-tight line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                            </div>
                            
                            <div class="flex justify-between items-center mt-auto pt-4 border-t border-gray-100 group-hover:border-orange-100 transition-colors">
                                <p class="text-base font-bold text-gray-900 whitespace-nowrap group-hover:text-[#E67E22] transition-colors">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <span class="text-xs text-gray-400 group-hover:text-black transition-all uppercase tracking-wider ml-2 flex items-center gap-1">
                                    View <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-20 fade-in-up">
                    <p class="text-gray-400 text-lg font-serif italic">No products found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>