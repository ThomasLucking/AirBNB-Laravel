<x-layout title="Edit Apartment">

    <body class="font-sans bg-gray-50 text-gray-900 flex">
        <main class="flex-1 flex flex-col items-center justify-center min-h-screen p-8">
            <div class="w-full max-w-xl space-y-6 bg-white p-8 rounded-xl shadow-sm border-2 border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit Listing</h2>
                    <p class="text-gray-500">Update the details of your apartment listing.</p>
                </div>
                <form action="{{ route('apartment.update', $apartment->id) }}" method="POST"
                    enctype="multipart/form-data" class="flex-row space-y-4">
                    @csrf
                    @method('PUT')
                    @if (session('error'))
                        <span class="text-red-500 text-xs">{{ session('error') }}</span>
                    @endif
                    @if ($errors->any())
                        <ul class="text-red-500 text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="m-8 flex flex-col gap-4">
                        <x-input-bar placeholder="Property Title" name="title" :value="old('title', $apartment->title)" />
                        <x-input-bar placeholder="Brief Description" name="description" :value="old('description', $apartment->description)" />
                        <x-input-bar placeholder="Country/Region" type="text" name="country" :value="old('country', $apartment->country)" />
                    </div>

                    <div class="m-8 flex flex-row gap-4">
                        <x-input-bar placeholder="Price per night" type="number" name="price_per_night"
                            :value="old('price_per_night', $apartment->price_per_night)" />
                        <x-input-bar placeholder="Number of Rooms" type="number" name="rooms" :value="old('rooms', $apartment->rooms)" />
                    </div>

                    <div class="flex flex-col justify-center items-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Property Images</label>
                        <div class="flex flex-wrap gap-2 mb-3">
                            <div class="relative">
                                <img alt="Property image" src="{{ $apartment->image_url }}"
                                    class="h-56 w-full object-cover">
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Upload new images to replace the existing ones.</p>
                        <x-file-upload name="image_housing[]" />
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                        Save Changes
                    </button>
                </form>
            </div>

        </main>
    </body>
</x-_layout>