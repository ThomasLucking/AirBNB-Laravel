<form method="GET" action="{{ route('apartment.all') }}">
    <div class="flex items-center justify-center p-4">
        <button id="filterDropdownBtn" data-dropdown-toggle="filterDropdown"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200 transition"
            type="button">
            <span>Filter By</span>
            @if(request()->filled('apartments') || request()->filled('bookings'))
                <span class="flex h-2 w-2 rounded-full bg-indigo-500"></span>
            @endif
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div id="filterDropdown" class="z-10 hidden w-56 bg-white divide-y divide-gray-100 rounded-lg shadow-xl dark:bg-gray-700 dark:divide-gray-600">
            <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <input onchange="this.form.submit()" @checked(request()->filled(key: 'apartments')) 
                            name="apartments" id="apartments" type="checkbox" value="apartments"
                            class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer">
                        <span class="ms-3 font-medium group-hover:text-indigo-600 transition-colors">My Apartments</span>
                    </label>
                </li>
                <li>
                    <label class="flex items-center cursor-pointer group">
                        <input onchange="this.form.submit()" @checked(request()->filled(key: 'bookings')) 
                            name="bookings" id="bookings" type="checkbox" value="bookings"
                            class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer">
                        <span class="ms-3 font-medium group-hover:text-indigo-600 transition-colors">My Bookings</span>
                    </label>
                </li>
            </ul>

            @if(request()->filled('apartments') || request()->filled('bookings'))
                <div class="py-2 px-3 bg-gray-50 dark:bg-gray-800 rounded-b-lg">
                    <a href="{{ route('apartment.all') }}"
                        class="flex items-center justify-center w-full px-2 py-1.5 text-xs font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors uppercase tracking-wider">
                        <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear All
                    </a>
                </div>
            @endif
        </div>
    </div>
</form>