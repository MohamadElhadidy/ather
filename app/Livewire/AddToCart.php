<?php

namespace App\Livewire;

use Livewire\Component;

class AddToCart extends Component
{

    public $productId;

    public function add()
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$this->productId])) {
            $cart[$this->productId]++; // increment quantity
        } else {
            $cart[$this->productId] = 1; // first time add
        }

        session()->put('cart', $cart);

        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
