<div >
    <h2 class="text-2xl font-bold tracking-tight text-blue-900 ">Products</h2>



    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
        @foreach ($products as $product)

            <div class="group relative" wire:key="product-list-{{ $product->id }}">
                <img src="{{ 'storage/' . $product->images?->first()?->path }}"
                    alt="Front of men&#039;s Basic Tee in black."
                    class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                <div class="mt-4 flex justify-between">
                    <div>
                        <h3 class="text-sm text-gray-700">
                            <a href="#">
                                {{ $product->name }}
                            </a>
                        </h3>
                    </div>
                    <p class="text-sm font-medium text-gray-900">{{ $product->price }}</p>
                </div>

                <livewire:add-to-cart wire:key="add-to-cart-{{  $product->id }}"  :productId="$product->id"/>


            </div>
        @endforeach
    </div>

    <div class="w-full text-center">
        <a href="/shop" class="bg-black text-white px-2 py-1 rounded-lg font-semibold">View all</a>
    </div>


</div>