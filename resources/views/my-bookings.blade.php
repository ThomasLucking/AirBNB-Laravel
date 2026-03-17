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
    <main class="flex-1 flex flex-col items-center min-h-screen">
        <h1 class="text-2xl font-bold mb-6 mt-4">My Bookings</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($bookings as $booking)
                <div class="max-w-sm m-8">
                    <article class="overflow-hidden rounded-lg border border-gray-800 bg-white shadow-xs">
                        <img alt="" src="{{ $booking->apartment->image_url }}" class="h-56 w-full object-cover">

                        <div class="p-2.5 sm:p-4">
                            <h3 class="text-lg font-medium text-black">{{ $booking->apartment->title }}</h3>

                            <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                                {{ $booking->apartment->description }}</p>

                            <div class="space-y-2 mt-3">
                                <p class="font-bold text-black italic">Total: ${{ $booking->total }}</p>
                            </div>

                            <a href="{{ route('apartment.show', $booking->apartment) }}"
                                class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-[#FF645C]">
                                View Apartment
                                <span aria-hidden="true" class="text-2xl block transition-all group-hover:ms-0.5">→</span>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500">You have no bookings yet.</p>
                    <a href="{{ route('home') }}"
                        class="mt-4 inline-block text-[#FF645C] font-medium hover:underline">Browse apartments</a>
                </div>
            @endforelse
        </div>
        <div class="mt-6 px-6">
            {{ $bookings->links() }}
        </div>

    </main>
</body>

</html>