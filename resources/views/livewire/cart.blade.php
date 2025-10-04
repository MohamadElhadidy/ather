<div>
    @foreach ($items as $item)
        <img src="{{ 'storage/' . $item['image'] }}" alt="Front of men&#039;s Basic Tee in black."
            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />

        <p>{{ $item['name'] }} </p>
        <p>{{ $item['price'] }} </p>
        <p><input type="text" value="{{ $item['qty'] }}" wire:change="update({{ $item['id'] }}, $event.target.value)" />
        </p>
        <p>{{ $item['subtotal'] }} </p>

        <button type="button" wire:click="remove({{ $item['id'] }})" wire:key="{{ $item['id'] }}">Remove</button>
    @endforeach

    <p>Total: {{ $total }}</p>
</div>