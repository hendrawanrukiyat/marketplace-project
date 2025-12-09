<div x-data="{ showModal: false, selectedProductId: null }">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Manajemen Produk Saya
        </h1>
        
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-[#E67E22] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#D35400] active:bg-[#E67E22] focus:outline-none ...">
            + Tambah Produk Baru
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi (Singkat)
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->cover_image_path)
                                    <img src="{{ asset('storage/' . $product->cover_image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="h-12 w-12 object-cover rounded-md shadow">
                                @else
                                    <span class="text-xs text-gray-400">No Image</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap max-w-xs">
                                <div class="text-sm text-gray-500 truncate">
                                    {{ \Illuminate\Support\Str::limit($product->description, 40, '...') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->status == 'published')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @elseif ($product->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Pending
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                
                                <button 
                                    @click="showModal = true; selectedProductId = {{ $product->id }}"
                                    class="text-red-600 hover:text-red-900 ml-4">
                                    Delete
                                </button>

                                @if ($product->status == 'draft')
                                    <button 
                                        wire:click="submitForReview({{ $product->id }})"
                                        class="text-green-600 hover:text-green-900 ml-4">
                                        Ajukan Review
                                    </button>
                                @endif
                            </td>
                            </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                Anda belum memiliki produk.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div x-show="showModal" x-transition:enter="transition ease-out duration-300" ...
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" 
         style="display: none;">
        
        <div @click.away="showModal = false" 
             class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto">
            
            <h3 class="text-lg font-medium text-gray-900">
                Konfirmasi Hapus Produk
            </h3>
            <div class="mt-2">
                <p class="text-sm text-gray-600">
                    Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button @click="showModal = false" 
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Batal
                </button>
                <button 
                    @click="
                        $wire.delete(selectedProductId); 
                        showModal = false;
                    "
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

</div>