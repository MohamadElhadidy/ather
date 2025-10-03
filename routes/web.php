<?php

use App\Livewire\ProductsList;
use App\Livewire\Shop;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductsList::class);
Route::get('/shop', Shop::class);