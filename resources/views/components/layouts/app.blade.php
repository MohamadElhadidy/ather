<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="text-center py-3 border-b-2 border-gray-100">
        <p class="font-medium text-xs font-roboto">Welcome to our store</p>
    </div>
    <nav class="flex justify-around py-6">
        <ul class="flex space-x-4">
            <li><a href="/" class="font-bold font-roboto text-xl">My Store</a></li>
            <li><a href="/">Home</a></li>
            <li><a href="/shop">Catalog</a></li>
        </ul>
        <ul class="flex space-x-4">
            <li><a href="/account"><x-heroicon-o-user class="w-7 h-7" /></a></li>
            <livewire:cart-icon/>
        </ul>
    </nav>
   

    {{ $slot }}

</body>

</html>