<x-_layout>
    <div class="font-sans bg-gray-50 text-gray-900 flex flex-row h-screen">
        <x-navbar />
        <main class="flex-1 overflow-y-auto px-8 py-10">
            <h1 class="text-3xl font-bold mb-8">Top Destinations</h1>

            @forelse($locationData as $data)
                <div class="mb-16">
                    <div class="flex items-center gap-4 mb-6">
                        <h2 class="text-2xl font-bold text-black whitespace-nowrap">{{ $data['location'] }}</h2>
                        <hr class="w-full border-gray-300">
                    </div>
                    <p class="text-gray-500 mb-4">Top apartments in {{ $data['location'] }}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl">
                        @foreach($data['apartments'] as $apartment)
                            <article class="overflow-hidden rounded-lg border border-gray-800 bg-white shadow-xs">
                                @if($apartment->images->first())
                                    <img src="{{ Storage::url($apartment->images->first()->image_path) }}"
                                         class="h-56 w-full object-cover"
                                         alt="{{ $apartment->title }}">
                                @else
                                    <div class="h-56 w-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        No image
                                    </div>
                                @endif

                                <div class="p-2.5 sm:p-4">
                                    <h3 class="text-lg font-medium text-black">{{ $apartment->title }}</h3>
                                    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">
                                        {{ $apartment->description }}
                                    </p>
                                    <div class="space-y-2 mt-3">
                                        <p class="font-bold text-black italic">{{ $apartment->price_per_night }}$/night</p>
                                    </div>
                                    <a href="{{ route('apartment.show', $apartment) }}"
                                       class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-[#FF645C]">
                                        View Apartment
                                        <span aria-hidden="true" class="text-2xl block transition-all group-hover:ms-0.5">→</span>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <p class="text-gray-500 text-lg">No popular destinations yet.</p>
                    <a href="{{ route('apartment.all') }}"
                       class="mt-4 inline-block text-[#FF645C] font-medium hover:underline">Browse all apartments</a>
                </div>
            @endforelse
        </main>
    </div>
</x-_layout>