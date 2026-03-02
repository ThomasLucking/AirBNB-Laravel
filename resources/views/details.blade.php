<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Airbnb Clone') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</head>

<body class="font-sans bg-gray-50 text-gray-900 flex">
    <x-navbar />
    <main class="flex-1 flex flex-col items-center min-h-screen p-8">
        <div class="w-full max-w-4xl">
            <h1 class="text-4xl font-bold mb-6">{{ $apartment->title }}</h1>
            
            <div class="mb-8">
                @if ($apartment->images->count() > 0)
                    <img src="{{ asset('storage/' . $apartment->images->first()->image_path) }}" 
                        alt="{{ $apartment->title }}" 
                        class="w-full h-96 object-cover rounded-lg shadow-lg">
                @else
                    <img src="https://via.placeholder.com/800x400?text=No+Image" 
                        alt="{{ $apartment->title }}" 
                        class="w-full h-96 object-cover rounded-lg shadow-lg">
                @endif
            </div>


            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-gray-600 text-sm">Rooms</p>
                        <p class="text-2xl font-bold">{{ $apartment->rooms }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Price per Night</p>
                        <p class="text-2xl font-bold">${{ $apartment->price_per_night }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-gray-600 text-sm mb-2">Description</p>
                    <p class="text-gray-800">{{ $apartment->description }}</p>
                </div>

                <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg">
                    Book Now
                </button>
            </div>
        </div>
    </main>
</body>

</html>