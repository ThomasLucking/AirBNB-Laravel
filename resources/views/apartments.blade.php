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

    <main class="flex-1 flex flex-col items-center justify-center min-h-screen p-8">

        <div class="w-full max-w-xl space-y-6 bg-white p-8 rounded-xl shadow-sm border-2 border-gray-200 ">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Create New Listing</h2>
                <p class="text-gray-500">Fill in the details to list your apartment.</p>
            </div>

            
            <form action="{{ route('apartment.store') }}" method="POST" enctype="multipart/form-data" class="flex-row space-y-4">
                @csrf
                <div class="m-8 flex flex-col gap-4">
                    <x-input-bar placeholder="Property Title" name="title" />
                    <x-input-bar placeholder="Brief Description" name="description" />
                    <x-input-bar placeholder="Country/Region" type="text" name="country" />
                </div>

                <div class="m-8 flex flex-row gap-4">
                    <x-input-bar placeholder="Price per night" type="number" name="price_per_night"  value="$"/>
                    <x-input-bar placeholder="Number of Rooms" type="number" name="rooms"  />
                </div>

                <div class="flex flex-col justify-center items-center">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Property Images</label>
                    <x-file-upload name="image_housing[]" />
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                    Publish Listing
                </button>
            </form>
        </div>

    </main>

</body>