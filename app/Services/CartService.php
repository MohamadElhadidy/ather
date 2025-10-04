<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected string $cartKey;


    public function __construct()
    {
        $this->cartKey = $this->getCartKey();
    }

    private function getCartKey(): string
    {
        if (Auth::check()) {
            return 'cart_user_' . Auth::id();
        }

        return 'cart_session_' . Session::getId();
    }

    public function all(): array
    {
        return session()->get($this->cartKey, []);
    }


    public function add(int $productId, int $quantity = 1)
    {
        $cart = $this->all();
        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;

        $this->set($cart);
    }


    public function update($productId, $qty)
    {
        $cart = $this->all();
        if ($qty <= 0) {
            unset($cart[$productId]);

        } else {
            $cart[$productId] = $qty;
        }
        $this->set($cart);
    }

    public function remove($productId)
    {
        $cart = $this->all();
        unset($cart[$productId]);
        $this->set($cart);
    }

    private function set($cart)
    {
        session()->put($this->cartKey, $cart);
    }

    public function getDetailedCart()
    {
        $cart = $this->all();

        if (empty($cart)) {
            return [
                'items' => [],
                'total' => 0
            ];
        }

        $products = Product::whereIn('id', array_keys($cart))->with('images')->get();

        $items = $products->map(function ($product) use ($cart) {
            $qty = (int) $cart[$product->id];
            $subtotal = $qty * $product->price;
            $image = $product->images?->first()?->path;

            return [
                'id' => $product->id,
                'image' => $image,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
                'subtotal' => $subtotal,
            ];

        })->toArray();

        $total = array_sum(array_column($items, 'subtotal'));

        return compact('items', 'total');
    }


    public function count(): int
    {
        return array_sum($this->all());
    }
}