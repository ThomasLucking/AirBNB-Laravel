<form method="GET" action="{{ route('apartment.all') }}">
    <div class="flex items-center justify-center p-4">
        <button id="sortingDropdownBtn" data-dropdown-toggle="sortingDropdown"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700 transition"
            type="button">
            <span>Sorting</span>
            
            @if(request()->filled('sort_price') || request()->filled('sort_rooms'))
                <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
            @endif
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="sortingDropdown"
            class="z-10 hidden w-60 mt-2 bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700">
            
            <ul class="p-3 space-y-1">
                <li>
                    <label class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer group">
                        <input onchange="this.form.submit()" @checked(request()->filled('sort_price')) 
                            id="sort_price" type="checkbox" name="sort_price" value="sort_price"
                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-500" />
                        <span class="text-sm text-gray-700 dark:text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white">Price</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer group">
                        <input onchange="this.form.submit()" @checked(request()->filled('sort_rooms')) 
                            id="sort_rooms" type="checkbox" name="sort_rooms" value="sort_rooms"
                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-500" />
                        <span class="text-sm text-gray-700 dark:text-gray-200 group-hover:text-gray-900 dark:group-hover:text-white">Number of Rooms</span>
                    </label>
                </li>
            </ul>


            @if(request()->filled('sort_price') || request()->filled('sort_rooms'))
                <div class="py-2 px-3 bg-gray-50 dark:bg-gray-800 rounded-b-xl border-t border-gray-100 dark:border-gray-700">
                    <a href="{{ route('apartment.all') }}"
                        class="flex items-center justify-center w-full px-2 py-1.5 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors uppercase tracking-wider">
                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear Sorting
                    </a>
                </div>
            @endif
        </div>
    </div>
</form>