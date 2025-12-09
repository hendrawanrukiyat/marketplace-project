<?php

use App\Livewire\CartPage;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\ProductForm;
use App\Livewire\ProductManagement;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/katalog', ProductCatalog::class)->name('catalog.index');
Route::get('/produk/{product}', ProductDetail::class)->name('product.detail');


Route::get('/dashboard', function () {
    // Cek role user yang baru login
    if (Auth::user()->role == 'admin') {
        // Jika admin, kirim ke dashboard admin
        return Redirect::route('admin.dashboard');
    } else {
        // Jika bukan, kirim ke dashboard pelaku ekraf
        return Redirect::route('products.index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/products', ProductManagement::class)->middleware(['auth', 'verified'])->name('products.index');


Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/all-products', \App\Livewire\Admin\ProductList::class)->name('products'); // <-- BARU
    Route::get('/sellers', \App\Livewire\Admin\SellerList::class)->name('sellers'); // <-- BARU (Untuk langkah 3 nanti)

});


Route::get('/products/create', ProductForm::class)->middleware(['auth', 'verified'])->name('products.create');
// {product} adalah parameter dinamis yang akan berisi ID produk
Route::get('/products/{product}/edit', ProductForm::class)->middleware(['auth', 'verified'])->name('products.edit');

Route::middleware('auth')->group(function () {
    Route::get('/cart', CartPage::class)->name('cart.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // INI YANG SUDAH DIPERBAIKI:
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';