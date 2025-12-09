<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination; // Untuk halaman 1, 2, 3...
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ProductList extends Component
{
    use WithPagination;

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            if ($product->cover_image_path) {
                Storage::disk('public')->delete($product->cover_image_path);
            }
            $product->delete();
        }
    }

    public function render()
    {
        // Ambil semua produk, urutkan terbaru
        $products = Product::with('user')->latest()->paginate(10);

        return view('livewire.admin.product-list', [
            'products' => $products
        ]);
    }
}