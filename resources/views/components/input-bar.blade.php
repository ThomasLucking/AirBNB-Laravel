@props([
    'placeholder' => 'default placeholder',
    'type' => 'text',
    'name' => '',
    'value' => ''
])

<div class="w-full max-w-md">
    <div class="flex items-center justify-center text-sm bg-white h-12 border rounded-lg border-gray-300 px-3 
                transition-all duration-200 focus-within:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-500/10">
        <input 
            class="w-full h-full outline-none text-gray-700 bg-transparent placeholder-gray-400" 
            type="{{ $type }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            multiple
        >

        <div class="text-gray-400 ml-2">
            @if($type === 'number')
                <span class="font-medium">{{ $value }}</span>
            @else
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 15.75v-1.5a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v1.5m9-10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0" 
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            @endif
        </div>
    </div>
</div>