<?php

namespace App\Livewire;

use App\Services\CartService;
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
        $this->cartCount = (new CartService())->count();
        
    }


    public function render()
    {
        return view('livewire.cart-icon');
    }
}
