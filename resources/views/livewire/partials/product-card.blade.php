<div class="group cursor-pointer h-full">
    <a href="{{ route('product.detail', $product) }}" class="block h-full flex flex-col border border-gray-200 rounded-xl overflow-hidden hover:border-gray-300 hover:shadow-lg transition-all duration-300 bg-white">
        
        <div class="relative w-full aspect-[4/5] overflow-hidden bg-gray-100">
            <img src="{{ asset('storage/' . $product->cover_image_path) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-out">
            
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition duration-500"></div>
        </div>

        <div class="p-5 flex flex-col flex-grow">
            <div class="mb-4">
                <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">{{ $product->category }}</p>
                <h3 class="text-lg font-serif font-medium text-gray-900 group-hover:text-[#E67E22] transition-colors leading-tight line-clamp-2">
                    {{ $product->name }}
                </h3>
            </div>
            
            <div class="flex justify-between items-end mt-auto pt-4 border-t border-gray-100">
                <p class="text-base font-bold text-gray-900 whitespace-nowrap">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <span class="text-xs text-gray-400 group-hover:text-black transition-colors uppercase tracking-wider ml-2">View ↗</span>
            </div>
        </div>
    </a>
</div>