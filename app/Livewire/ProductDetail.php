<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\ProductViewLog;
use App\Models\Cart; // <-- 1. Impor Model Cart
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth; // <-- 2. Impor Auth

#[Layout('layouts.public')]
class ProductDetail extends Component
{
    public Product $product;

    public function mount(Product $product)
    {
        $this->product = $product;

        // Mencatat Views (Tetap ada)
        ProductViewLog::create([
            'product_id' => $product->id,
            'ip_address' => Request::ip()
        ]);
    }

    // --- 3. FUNGSI TAMBAH KE KERANJANG ---
    public function addToCart()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah produk ini sudah ada di keranjang user?
        $existingCart = Cart::where('user_id', Auth::id())
                            ->where('product_id', $this->product->id)
                            ->first();

        if ($existingCart) {
            // Jika sudah ada, tambahkan jumlahnya (+1)
            $existingCart->increment('quantity');
        } else {
            // Jika belum ada, buat baris baru
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => 1
            ]);
        }

        // Berikan notifikasi sukses (Flash Message)
        session()->flash('message', 'Produk berhasil masuk keranjang!');
        
        // Opsional: Bisa redirect ke halaman keranjang nanti
        // return redirect()->route('cart.index'); 
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}