@props(['apartment'])

<div class="max-w-sm m-8">
<article class="overflow-hidden rounded-lg border border-gray-800 bg-white shadow-xs">
  <img alt="" src="{{ $apartment->image_url }}" class="h-56 w-full object-cover">

  <div class="p-2.5 sm:p-4">
    <h3 class="text-lg font-medium text-black">{{ $apartment->title }}</h3>

    <p class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500">{{ $apartment->description }}</p>

    <div class="space-y-2">
        <p class="font-bold text-black italic">Price: ${{ $apartment->price_per_night }}</p>
        @if ($apartment->iscurrentlyBooked())
            <span class="inline-flex items-center rounded-md bg-yellow-100 px-2 py-1 text-xs font-bold text-yellow-800">
                Currently Booked
            </span>
        @endif
        <span class="inline-flex items-center rounded-md bg-[#FF645C] px-2 py-1 text-xs font-bold text-black">
            {{ $apartment->rooms }}-room apartment
        </span>
    </div>

    <a href="{{ route('apartment.show', $apartment) }}" class="group mt-4 inline-flex items-center gap-1 text-sm font-medium text-[#FF645C]">
      See more details
      <span aria-hidden="true" class="text-2xl block transition-all group-hover:ms-0.5">→</span>
    </a>
  </div>
</article>
</div>