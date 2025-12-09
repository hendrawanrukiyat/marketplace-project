<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.public')] // Gunakan layout publik (dengan navbar)
class CartPage extends Component
{
    // Fungsi untuk menghapus item
    public function removeItem($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->delete();
        }
    }

    // Fungsi untuk menambah jumlah (+1)
    public function increaseQty($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->increment('quantity');
        }
    }

    // Fungsi untuk mengurangi jumlah (-1)
    public function decreaseQty($cartId)
    {
        $cart = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
        if ($cart) {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
            } else {
                // Jika sisa 1 dikurangi, tanyakan mau dihapus? (Untuk sekarang biarkan 1)
            }
        }
    }

    public function render()
    {
        // Ambil semua item di keranjang milik user yang login
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();

        // Hitung Total Harga
        $grandTotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('livewire.cart-page', [
            'cartItems' => $cartItems,
            'grandTotal' => $grandTotal
        ]);
    }
}