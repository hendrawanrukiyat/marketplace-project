<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage; // <-- 1. TAMBAHKAN INI

#[Layout('layouts.pelaku-ekraf')]
class ProductManagement extends Component
{
    // ... (Fungsi render() Anda tetap di sini) ...
    public function render()
    {
        $products = Product::where('user_id', Auth::id())->get();

        return view('livewire.product-management', [
            'products' => $products
        ]);
    }

    // --- 2. TAMBAHKAN FUNGSI BARU DI BAWAH INI ---
    public function delete($productId)
    {
        // 3. Cari produknya
        $product = Product::where('id', $productId)
                          ->where('user_id', Auth::id()) // Pastikan user ini pemiliknya
                          ->first();

        if ($product) {
            // 4. Hapus file gambar dari storage
            if ($product->cover_image_path) {
                Storage::disk('public')->delete($product->cover_image_path);
            }

            // 5. Hapus produk dari database
            $product->delete();

            // 6. Refresh data (opsional, tapi bagus)
            // $this->mount(); // atau biarkan Livewire menanganinya
        }

        // Livewire akan otomatis me-refresh halaman setelah ini
    }

    // --- TAMBAHKAN FUNGSI BARU INI ---
    public function submitForReview($productId)
    {
        // Cari produk, pastikan milik user ini & statusnya 'draft'
        $product = Product::where('id', $productId)
                          ->where('user_id', Auth::id())
                          ->where('status', 'draft')
                          ->first();

        if ($product) {
            // Ubah statusnya menjadi 'pending'
            $product->update(['status' => 'pending']);
        }

        // Livewire akan otomatis me-refresh halaman setelah ini
    }
}