<div class="min-h-screen bg-white text-black font-sans selection:bg-orange-100 selection:text-orange-900">
    
    <style>
        /* Menyembunyikan Navbar bawaan dari Layout Utama */
        body > div:first-of-type { display: none !important; }
        
        /* Animasi Masuk (Fade In Up) */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0; 
        }
        
        /* Sembunyikan Scrollbar tapi tetap bisa scroll */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="relative bg-[#FFFCF5] pb-32 pt-10 lg:pt-16 overflow-hidden border-b border-gray-100">
        <div class="absolute inset-0" style="background-image: linear-gradient(#E5E7EB 1px, transparent 1px), linear-gradient(to right, #E5E7EB 1px, transparent 1px); background-size: 40px 40px; opacity: 0.4;"></div>
        
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
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-bold text-black border-2 border-black rounded-full hover:bg-black hover:text-white transition-all duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2.5 text-sm font-bold text-white bg-[#E67E22] rounded-full shadow-lg hover:bg-[#D35400] hover:shadow-orange-500/50 transition-all transform hover:-translate-y-1">Login Pelaku Ekraf</a>
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
                        Jelajahi koleksi terkurasi dari 18 Subsektor Ekonomi Kreatif Majalengka.
                    </p>
                    <form wire:submit.prevent="$refresh" class="relative group w-full">
                        <input wire:model.defer="search" type="text" class="w-full bg-white border-0 rounded-full py-4 pl-6 pr-14 text-lg text-gray-900 placeholder-gray-400 shadow-xl ring-1 ring-gray-100 focus:ring-2 focus:ring-[#E67E22] transition-all duration-300 transform focus:-translate-y-1" placeholder="Cari inspirasi...">
                        <button type="submit" class="absolute right-2 top-2 p-2 bg-[#E67E22] text-white rounded-full hover:bg-[#D35400] hover:scale-110 transition-all duration-300 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="pt-10 flex flex-wrap gap-3 justify-center md:justify-start fade-in-up" style="animation-delay: 0.2s;">
                <button wire:click="$set('selectedCategory', '')" class="px-5 py-2.5 border rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105 {{ $selectedCategory == '' ? 'bg-black text-white' : 'bg-transparent hover:border-black' }}">All</button>
                @foreach(['Animasi', 'Arsitektur', 'Desain', 'Fotografi', 'Musik', 'Kriya', 'Kuliner', 'Fashion', 'R&D', 'Penerbitan', 'Perfilman', 'Periklanan', 'Game', 'Seni Pertunjukan', 'Seni Rupa', 'TI', 'TV & Radio', 'Video'] as $cat)
                    <button wire:click="$set('selectedCategory', '{{ $cat }}')" class="px-5 py-2.5 border rounded-full text-sm font-medium transition-all duration-300 transform hover:scale-105 {{ $selectedCategory == $cat ? 'bg-black text-white' : 'bg-transparent hover:border-black' }}">{{ $cat }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white min-h-screen pb-24 relative z-10 rounded-t-[3rem] -mt-10 shadow-sm pt-12">
        <div class="max-w-[1400px] mx-auto px-6">

            @if($isGridMode)
                <div class="mb-8 fade-in-up">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Hasil Pencarian</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse ($products as $product)
                            <div class="group cursor-pointer h-full hover:-translate-y-2 transition-transform duration-300">
                                @include('livewire.partials.product-card', ['product' => $product])
                            </div>
                        @empty
                            <div class="col-span-full text-center py-20 text-gray-500">Tidak ada produk ditemukan.</div>
                        @endforelse
                    </div>
                </div>

            @else
                @foreach ($groupedProducts as $categoryName => $products)
                    @if($products->count() > 0)
                        <div class="mb-16 border-b border-gray-100 pb-12 last:border-0 fade-in-up" style="animation-delay: {{ ($loop->index * 0.1) + 0.3 }}s">
                            
                            <div class="flex justify-between items-end mb-8">
                                <div>
                                    <span class="text-xs font-bold text-[#E67E22] tracking-widest uppercase mb-1 block">Subsektor</span>
                                    <h2 class="text-3xl font-serif text-gray-900">{{ $categoryName }}</h2>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="document.getElementById('scroll-{{ $loop->index }}').scrollBy({left: -320, behavior: 'smooth'})" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-black hover:bg-black hover:text-white transition-all duration-300 transform hover:scale-110 active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                    <button onclick="document.getElementById('scroll-{{ $loop->index }}').scrollBy({left: 320, behavior: 'smooth'})" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-black hover:bg-black hover:text-white transition-all duration-300 transform hover:scale-110 active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div id="scroll-{{ $loop->index }}" class="flex gap-6 overflow-x-auto pb-8 snap-x scrollbar-hide scroll-smooth" style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach ($products as $product)
                                    <div class="flex-shrink-0 w-72 snap-start group cursor-pointer hover:-translate-y-2 transition-transform duration-500">
                                        @include('livewire.partials.product-card', ['product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach

                @if($currentLimit < $totalCategories)
                    <div class="text-center mt-12 fade-in-up" style="animation-delay: 0.5s">
                        <button wire:click="loadMoreCategories" class="px-8 py-4 bg-gray-900 text-white font-bold rounded-full hover:bg-[#E67E22] hover:shadow-lg hover:shadow-orange-500/30 transition-all transform hover:-translate-y-1 active:translate-y-0">
                            Tampilkan Subsektor Lainnya
                        </button>
                        <p class="text-xs text-gray-400 mt-3">Menampilkan {{ $currentLimit }} dari {{ $totalCategories }} Subsektor</p>
                    </div>
                @endif

            @endif

        </div>
    </div>
</div>