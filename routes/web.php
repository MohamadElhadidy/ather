<?php

use App\Livewire\ProductsList;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductsList::class);