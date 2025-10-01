<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount = 0;


    public function mount()
    {
        $this->updateCount();
    }

    #[On('cartUpdated')]
    public function cartUpdated()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $cart = session()->get('cart', []);
        $this->cartCount = array_sum($cart);
    }


    public function render()
    {
        return view('livewire.cart-icon');
    }
}
