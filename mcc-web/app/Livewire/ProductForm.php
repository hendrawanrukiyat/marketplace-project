<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; // <-- Pastikan ini ada

#[Layout('layouts.pelaku-ekraf')]
class ProductForm extends Component
{
    use WithFileUploads;

    // Properti untuk menampung data
    public $name;
    public $description;
    public $price;
    public $category;
    public $photo; // Untuk foto baru

    // Properti untuk mode Edit
    public ?Product $product = null; // Tipe data Product, bisa null
    public $oldPhotoPath; // Untuk menyimpan path foto lama

    // 1. FUNGSI MOUNT (berjalan saat komponen dimuat)
    // Fungsi ini akan menerima produk yang dikirim dari rute
    public function mount(Product $product)
    {
        if ($product->exists) {
            // --- MODE EDIT ---
            $this->product = $product;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->category = $product->category;
            $this->oldPhotoPath = $product->cover_image_path;
        }
        // Jika tidak ada $product, properti akan kosong (MODE TAMBAH BARU)
    }

    // 2. FUNGSI SAVE (diperbarui)
    public function save()
    {
        // Validasi data (sedikit diubah untuk foto)
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            // Foto sekarang 'nullable' (tidak wajib) saat mengedit
            'photo' => 'nullable|image|max:2048', 
        ]);

        $imagePath = $this->oldPhotoPath; // Default, gunakan foto lama

        // 3. Cek jika ada foto BARU yang di-upload
        if ($this->photo) {
            // Hapus foto lama jika ada
            if ($this->oldPhotoPath) {
                Storage::disk('public')->delete($this->oldPhotoPath);
            }
            // Simpan foto baru
            $imagePath = $this->photo->store('products', 'public');
        }

        // 4. Cek apakah kita sedang 'Update' (Edit) atau 'Create' (Baru)
        if ($this->product) {
            // --- UPDATE DATA (EDIT) ---
            $this->product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category' => $this->category,
                'cover_image_path' => $imagePath,
            ]);
            $message = 'Produk berhasil diperbarui!';

        } else {
            // --- CREATE DATA (BARU) ---
            Product::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category' => $this->category,
                'cover_image_path' => $imagePath,
                'status' => 'draft',
            ]);
            $message = 'Produk berhasil ditambahkan!';
        }

        // 5. Kembalikan user ke halaman produk
        return redirect()->route('products.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}