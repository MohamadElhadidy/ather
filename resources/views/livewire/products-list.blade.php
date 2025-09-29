<div class="bg-white w-full">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-blue-900 ">Products</h2>


        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @foreach ($products as $product)

                <div class="group relative">
                    <img src="{{ 'storage/'.  $product->images?->first()?->path }}"
                        alt="Front of men&#039;s Basic Tee in black."
                        class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="#">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <!-- <p class="mt-1 text-sm text-gray-500">Black</p> -->
                        </div>
                        <p class="text-sm font-medium text-gray-900">{{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="/shop" class="text-center">View all</a>


    </div>
</div>