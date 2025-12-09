<div x-data="{ showCheckoutModal: false }" class="min-h-screen bg-gray-900 font-sans relative overflow-hidden">
    
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/MCC.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-40 blur-xl scale-110">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4 md:p-8">
        
        <a href="{{ route('catalog.index') }}" class="absolute top-6 left-6 md:top-10 md:left-10 inline-flex items-center text-white/80 hover:text-white transition group z-20">
            <div class="w-10 h-10 rounded-full bg-black/20 backdrop-blur-md flex items-center justify-center mr-3 group-hover:bg-[#E67E22] transition border border-white/10">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </div>
            <span class="font-medium tracking-wide">Kembali ke Katalog</span>
        </a>

        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-[2.5rem] shadow-2xl w-full max-w-6xl overflow-hidden flex flex-col lg:flex-row">
            
            <div class="w-full lg:w-3/5 bg-black/20 relative min-h-[400px] lg:min-h-[600px] group">
                <img src="{{ asset('storage/' . $product->cover_image_path) }}" 
                     alt="{{ $product->name }}" 
                     class="absolute inset-0 w-full h-full object-cover transition duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-8 left-8">
                    <span class="px-4 py-2 bg-white/90 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-widest text-gray-900 shadow-lg">
                        {{ $product->category }}
                    </span>
                </div>
            </div>

            <div class="w-full lg:w-2/5 p-8 md:p-12 flex flex-col bg-white/95 backdrop-blur-3xl text-gray-900">
                
                <div class="mb-auto">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-lg border border-gray-200">
                            {{ substr($product->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Kreator</p>
                            <p class="text-sm font-bold text-gray-900">{{ $product->user->name }}</p>
                        </div>
                    </div>

                    <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-6 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <div class="flex items-baseline gap-1 mb-8">
                        <span class="text-lg font-medium text-[#E67E22]">Rp</span>
                        <span class="text-5xl font-bold text-gray-900 tracking-tighter">
                            {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="prose prose-sm text-gray-600 mb-8 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100 space-y-3">
                    
                    @if (session()->has('message'))
                        <div class="p-3 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-bold text-center mb-2">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-3">
                        <button wire:click="addToCart" 
                                class="flex items-center justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-[#E67E22] hover:bg-[#D35400] transition shadow-lg hover:shadow-orange-500/20 hover:-translate-y-0.5 transform">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            + Keranjang
                        </button>

                        <button @click="showCheckoutModal = true"
                                class="flex items-center justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gray-900 hover:bg-black transition shadow-lg hover:shadow-gray-500/20 hover:-translate-y-0.5 transform">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Beli Langsung
                        </button>
                    </div>

                    <a href="https://wa.me/?text=Halo, saya tertarik dengan produk {{ $product->name }}" target="_blank" 
                       class="flex items-center justify-center py-3.5 px-4 border-2 border-gray-200 text-sm font-bold rounded-xl text-gray-600 hover:border-[#E67E22] hover:text-[#E67E22] transition bg-white">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Chat Penjual
                    </a>

                </div>

            </div>
        </div>
    </div>

    <div x-show="showCheckoutModal" 
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        
        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0"
             @click="showCheckoutModal = false"
             class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 scale-90"
             class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center">
            
            <div class="w-16 h-16 bg-orange-100 text-[#E67E22] rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">Fitur Dalam Pengembangan</h3>
            <p class="text-gray-500 mb-8">
                Maaf, sistem pembayaran otomatis (Checkout) sedang dikembangkan. Silakan gunakan fitur Chat Penjual.
            </p>
            
            <button @click="showCheckoutModal = false" class="w-full py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-black transition">
                Mengerti
            </button>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
    </style>

</div>