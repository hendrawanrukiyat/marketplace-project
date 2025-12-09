<div class="min-h-screen bg-gray-50 pt-24 pb-24" x-data="{ showCheckoutModal: false }">
    
    <div class="max-w-[1400px] mx-auto px-6">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

        @if($cartItems->count() > 0)
            <div class="flex flex-col lg:flex-row gap-10">
                
                <div class="flex-1 space-y-6">
                    @foreach($cartItems as $item)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center gap-6">
                            
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-100 rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $item->product->cover_image_path) }}" 
                                     class="w-full h-full object-cover">
                            </div>

                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->product->category }}</p>
                                <p class="text-[#E67E22] font-bold mt-2">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <button wire:click="decreaseQty({{ $item->id }})" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">-</button>
                                <span class="w-8 text-center font-bold">{{ $item->quantity }}</span>
                                <button wire:click="increaseQty({{ $item->id }})" class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100">+</button>
                            </div>

                            <button wire:click="removeItem({{ $item->id }})" class="text-red-500 hover:text-red-700 p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="lg:w-96 flex-shrink-0">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Belanja</h3>
                        
                        <div class="flex justify-between items-center mb-4 text-gray-600">
                            <span>Total Item</span>
                            <span>{{ $cartItems->sum('quantity') }} pcs</span>
                        </div>
                        
                        <div class="border-t border-gray-100 my-4"></div>
                        
                        <div class="flex justify-between items-center mb-8">
                            <span class="text-lg font-bold text-gray-900">Total Harga</span>
                            <span class="text-2xl font-bold text-[#E67E22]">
                                Rp {{ number_format($grandTotal, 0, ',', '.') }}
                            </span>
                        </div>

                        <button @click="showCheckoutModal = true" class="w-full py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-black transition shadow-lg">
                            Checkout Sekarang
                        </button>
                    </div>
                </div>

            </div>
        
        @else
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Anda Kosong</h2>
                <p class="text-gray-500 mb-8">Yuk, mulai jelajahi produk kreatif Majalengka!</p>
                <a href="{{ route('catalog.index') }}" class="px-8 py-3 bg-[#E67E22] text-white font-bold rounded-full hover:bg-[#D35400] transition">
                    Mulai Belanja
                </a>
            </div>
        @endif

    </div>

    <div x-show="showCheckoutModal" 
         class="fixed inset-0 z-50 flex items-center justify-center px-4"
         style="display: none;">
        
        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0"
             @click="showCheckoutModal = false"
             class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-end="opacity-0 scale-90"
             class="relative bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full text-center">
            
            <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2">Fitur Dalam Pengembangan</h3>
            <p class="text-gray-500 mb-8">
                Integrasi pembayaran (Midtrans) dan checkout sedang disiapkan. Terima kasih telah mencoba demo ini.
            </p>
            
            <button @click="showCheckoutModal = false" class="w-full py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-black transition">
                Tutup
            </button>
        </div>
    </div>

</div>