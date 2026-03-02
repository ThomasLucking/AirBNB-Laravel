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
        <h1 class="text-2xl font-bold mb-6 mt-4">All Apartments</h1>
        <div class="flex flex-row gap-4">
            <x-filter />
            <x-sorting />
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($apartments as $apartment)
                @if ($apartment->images->count() > 0)
                    <x-property-card :apartment="$apartment" />
                @else
                    <x-property-card :apartment="$apartment" />
                @endif
            @endforeach
        </div>
        <div class="mt-6">{{ $apartments->links() }}</div>
    </main>
</body>

</html>