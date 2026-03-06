<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Airbnb Clone') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-50 text-gray-900 flex">
    <x-navbar />
    <main class="flex-1 flex flex-col items-center min-h-screen p-8">
        <div class="w-full ">
            @if ($hasActiveBooking)
                <x-cancel-booking :hasActiveBooking="$hasActiveBooking" />
            @endif
            <form method="POST" action="{{ route('bookings.store', $apartment) }}" class="w-full max-w-2xl mx-auto">
                @csrf
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 class="text-4xl font-bold mb-6">{{ $apartment->title }}</h1>
                <div class="mb-8">
                    @if ($apartment->images->count() > 0)
                        <div class="grid grid-cols-2 gap-2 h-96">
                            <img src="{{ $apartment->image_url }}" alt="{{ $apartment->title }}"
                                class="w-full h-full object-cover rounded-l-xl">
                            <div class="grid grid-cols-2 gap-2">
                                @foreach ($apartment->images->skip(1)->take(4) as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $apartment->title }}"
                                        class="w-full h-full object-cover last:rounded-br-xl first:rounded-tr-xl">
                                @endforeach
                            </div>
                        </div>
                    @else
                        <img src="https://via.placeholder.com/800x400?text=No+Image" alt="{{ $apartment->title }}"
                            class="w-full h-96 object-cover rounded-xl">
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
                        <div>
                            <p class="text-gray-600 text-sm">Location</p>
                            <p class="text-2xl font-bold">{{ $apartment->country }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-600 text-sm mb-2">Description</p>
                        <p class="text-gray-800">{{ $apartment->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start_date" class="block text-gray-600 text-sm mb-1">Check-in</label>
                            @error('start_date')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            @error('dataconflictError')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="end_date" class="block text-gray-600 text-sm mb-1">Check-out</label>
                            @error('end_date')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            @error('dataconflictError')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    @if ($hasActiveBooking)
                        <button form="delete_form" type="submit"
                            class="w-full bg-gray-400 hover:bg-gray-500 cursor-pointer text-white font-bold py-3 rounded-lg mt-3">
                            Cancel Booking
                        </button>
                    @else
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg">
                        Book Now
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </main>
</body>

</html>