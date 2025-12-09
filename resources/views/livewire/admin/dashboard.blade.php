<div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        Dashboard Admin
    </h1>
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Moderasi Produk (Menunggu Persetujuan)</h2>
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelaku Ekraf</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pendingProducts as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-md object-cover" src="{{ asset('storage/' . $product->cover_image_path) }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $product->category }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $product->user->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="approveProduct({{ $product->id }})" class="px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600">Setujui</button>
                                <button wire:click="rejectProduct({{ $product->id }})" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 ml-2">Tolak</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Tidak ada produk yang menunggu persetujuan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🔥 Produk Paling Sering Dilihat</h3>
                <ul class="divide-y divide-gray-100">
                    @forelse ($topProducts as $stat)
                        @if($stat->product)
                            <li class="flex justify-between py-3">
                                <div class="flex items-center">
                                    <span class="text-gray-500 font-medium mr-3">#{{ $loop->iteration }}</span>
                                    <span class="text-gray-900">{{ $stat->product->name }}</span>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $stat->total }} Views</span>
                            </li>
                        @endif
                    @empty
                        <li class="text-gray-500 text-sm italic">Belum ada data views.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">🔍 Pencarian Terpopuler</h3>
                <ul class="divide-y divide-gray-100">
                    @forelse ($topSearches as $search)
                        <li class="flex justify-between py-3">
                            <div class="flex items-center">
                                <span class="text-gray-500 font-medium mr-3">#{{ $loop->iteration }}</span>
                                <span class="text-gray-900 capitalize">{{ $search->term }}</span>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ $search->total }} Kali</span>
                        </li>
                    @empty
                        <li class="text-gray-500 text-sm italic">Belum ada data pencarian.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

</div>