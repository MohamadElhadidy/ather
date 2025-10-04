<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Component;

class AddToCart extends Component
{

    public $productId;

    public function add()
    {
        (new CartService())->add($this->productId);

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
