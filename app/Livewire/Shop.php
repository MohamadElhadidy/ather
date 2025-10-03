<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Shop extends Component
{

    public $products = [];

    public function mount() {
        $this->products = Product::with('images')->limit(6)->get();
    }
    public function render()
    {
        return view('livewire.shop');
    }
}
