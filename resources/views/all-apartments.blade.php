<x-layout>
    <div class="font-sans bg-gray-50 text-gray-900 flex flex-row h-screen">
        <main class="flex-1 overflow-y-auto flex flex-col items-center px-8 py-10">
            <h1 class="text-2xl font-bold mb-6">All Apartments</h1>
            <div class="flex flex-row gap-4 mb-6">
                <x-filter />
                <x-sorting />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($apartments as $apartment)
                    <x-property-card :apartment="$apartment" />
                @endforeach
            </div>
            <div class="mt-6">{{ $apartments->links() }}</div>
        </main>
    </div>
</x-layout>