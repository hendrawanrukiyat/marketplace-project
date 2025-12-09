<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;

#[Layout('layouts.admin')]
class SellerList extends Component
{
    use WithPagination;

    public function render()
    {
        // Ambil user yang role-nya 'pelaku_ekraf'
        $sellers = User::where('role', 'pelaku_ekraf')->latest()->paginate(10);

        return view('livewire.admin.seller-list', [
            'sellers' => $sellers
        ]);
    }
}