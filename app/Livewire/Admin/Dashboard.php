<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\ProductViewLog; // <-- Impor Model View
use App\Models\SearchTermLog;  // <-- Impor Model Search
use Illuminate\Support\Facades\DB; // <-- Impor DB Facade

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function approveProduct($productId)
    {
        $product = Product::find($productId);
        if ($product && $product->status == 'pending') {
            $product->update(['status' => 'published']);
        }
    }

    public function rejectProduct($productId)
    {
        $product = Product::find($productId);
        if ($product && $product->status == 'pending') {
            $product->update(['status' => 'draft']);
        }
    }

    public function render()
    {
        // 1. Ambil Produk Pending (Moderasi)
        $pendingProducts = Product::with('user')->where('status', 'pending')->get();

        // 2. Analisis: Top 5 Produk Paling Sering Dilihat
        $topProducts = ProductViewLog::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderByDesc('total')
            ->take(5)
            ->with('product') // Ambil nama produknya
            ->get();

        // 3. Analisis: Top 5 Kata Kunci Pencarian
        $topSearches = SearchTermLog::select('term', DB::raw('count(*) as total'))
            ->groupBy('term')
            ->orderByDesc('total')
            ->take(5)
            ->get();
        
        return view('livewire.admin.dashboard', [
            'pendingProducts' => $pendingProducts,
            'topProducts' => $topProducts,
            'topSearches' => $topSearches,
        ]);
    }
}