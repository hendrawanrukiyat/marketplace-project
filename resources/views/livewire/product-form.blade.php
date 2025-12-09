<div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        @if ($product)
            Edit Produk
        @else
            Tambah Produk Baru
        @endif
    </h1>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

            <form wire:submit.prevent="save" enctype="multipart/form-data">
                <div class="space-y-6">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input type="text" id="name" wire:model="name"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E67E22] focus:border-[#E67E22]">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                        <input type="file" id="photo" wire:model="photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none">

                        <div wire:loading wire:target="photo" class="text-sm text-gray-500 mt-1">Uploading...</div>

                        <div class="mt-4">
                            @if ($photo)
                                <span class="block text-sm font-medium text-gray-700">Preview (Baru):</span>
                                <img src="{{ $photo->temporaryUrl() }}" class="mt-2 h-48 w-auto rounded-md shadow-sm object-cover">
                            @elseif ($oldPhotoPath)
                                <span class="block text-sm font-medium text-gray-700">Gambar Saat Ini:</span>
                                <img src="{{ asset('storage/' . $oldPhotoPath) }}" class="mt-2 h-48 w-auto rounded-md shadow-sm object-cover">
                            @endif
                        </div>

                        @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" rows="4" wire:model="description"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E67E22] focus:border-[#E67E22]"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" id="price" placeholder="Contoh: 50000" wire:model="price"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E67E22] focus:border-[#E67E22]">
                        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Subsektor Ekonomi Kreatif</label>
                        <select id="category" wire:model="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#E67E22] focus:border-[#E67E22]">
                            <option value="">-- Pilih Subsektor --</option>
                            <option value="Animasi">1. Animasi</option>
                            <option value="Arsitektur">2. Arsitektur</option>
                            <option value="Desain">3. Desain (Grafis/Interior/Produk)</option>
                            <option value="Fotografi">4. Fotografi</option>
                            <option value="Musik">5. Musik</option>
                            <option value="Kriya">6. Kerajinan (Kriya)</option>
                            <option value="Kuliner">7. Kuliner</option>
                            <option value="Fashion">8. Mode (Fashion)</option>
                            <option value="R&D">9. Penelitian & Pengembangan</option>
                            <option value="Penerbitan">10. Penerbitan</option>
                            <option value="Perfilman">11. Perfilman</option>
                            <option value="Periklanan">12. Periklanan</option>
                            <option value="Game">13. Permainan Interaktif (Game)</option>
                            <option value="Seni Pertunjukan">14. Seni Pertunjukan</option>
                            <option value="Seni Rupa">15. Seni Rupa</option>
                            <option value="TI">16. Teknologi Informasi</option>
                            <option value="TV & Radio">17. Televisi & Radio</option>
                            <option value="Video">18. Video</option>
                        </select>
                        @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-[#E67E22] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#D35400] active:bg-[#E67E22] focus:outline-none focus:border-[#D35400] focus:ring focus:ring-orange-300 disabled:opacity-25 transition">
                            @if ($product)
                                Perbarui Produk
                            @else
                                Simpan Produk
                            @endif
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>