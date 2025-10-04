<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class Cart extends Component
{
    public $items = [];
    public $total = 0;

    public function mount(): void
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        ['items' => $this->items, 'total' => $this->total] = (new CartService())->getDetailedCart();
    }

    public function remove($productId)
    {
        (new CartService())->remove($productId);
        $this->loadCart();

        $this->dispatch('cartUpdated');

    }
    
    public function update($productId, $qty)
    {
        (new CartService())->update($productId, $qty);
        $this->loadCart();

        $this->dispatch('cartUpdated');

    }
    public function render()
    {
        return view('livewire.cart');
    }
}
