<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\SearchTermLog;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Request;

#[Layout('layouts.public')]
class ProductCatalog extends Component
{
    public $search = '';
    public $selectedCategory = ''; 
    public $limitCategories = 3; // Mulai dengan menampilkan 3 subsektor

    public function updatedSearch()
    {
        if (strlen($this->search) > 2) {
            SearchTermLog::create([
                'term' => $this->search,
                'ip_address' => Request::ip(),
            ]);
        }
    }

    // Fungsi untuk tombol "Tampilkan Lebih Banyak"
    public function loadMoreCategories()
    {
        $this->limitCategories += 3; // Tambah 3 kategori lagi setiap diklik
    }

    public function render()
    {
        // A. JIKA SEDANG MENCARI / FILTER: Tampilkan Grid Biasa (Flat)
        if ($this->search || $this->selectedCategory) {
            $query = Product::where('status', 'published');

            if ($this->search) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            }

            if ($this->selectedCategory) {
                $query->where('category', $this->selectedCategory);
            }

            return view('livewire.product-catalog', [
                'isGridMode' => true, // Mode Grid Biasa
                'products' => $query->get()
            ]);
        }

        // B. JIKA MODE JELAJAH (DEFAULT): Tampilkan Per-Subsektor (Rows)
        else {
            // 1. Ambil daftar semua kategori yang memiliki produk published
            $allCategories = Product::where('status', 'published')
                ->select('category')
                ->distinct()
                ->pluck('category');

            // 2. Potong kategori sesuai limit (Load More)
            $displayedCategories = $allCategories->take($this->limitCategories);

            // 3. Ambil produk untuk kategori yang ditampilkan saja
            $groupedProducts = [];
            foreach ($displayedCategories as $cat) {
                $groupedProducts[$cat] = Product::where('status', 'published')
                    ->where('category', $cat)
                    ->latest()
                    ->take(10) // Batasi 10 produk per baris agar ringan
                    ->get();
            }

            return view('livewire.product-catalog', [
                'isGridMode' => false, // Mode Baris/Carousel
                'groupedProducts' => $groupedProducts,
                'totalCategories' => $allCategories->count(),
                'currentLimit' => $this->limitCategories
            ]);
        }
    }
}