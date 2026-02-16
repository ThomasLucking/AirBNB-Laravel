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
    <div class="flex-1 flex items-center justify-center text-center">
        <div class="flex flex-col border-2 border-gray-300 rounded-lg p-8 bg-white shadow-lg">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-lg font-bold">AirBNB Laravel</h1>
            <h3 class="text-sm"> Enjoy your stay!</h3>
        </div>
    </div>
</body>

</html>