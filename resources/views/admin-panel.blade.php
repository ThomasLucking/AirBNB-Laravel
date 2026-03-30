<x-layout title="Admin Panel">

    <body class="font-sans bg-gray-50 text-gray-900">
        <main class="min-h-screen p-8">
            <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-sm border-2 border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Admin Panel</h2>
                    <p class="text-gray-500">Manage users across the platform.</p>
                </div>

                @if (session('success'))
                    <div class="text-green-600 text-sm font-medium bg-green-50 p-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="text-red-600 text-sm font-medium bg-red-50 p-3 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-y-3 mt-4">
                    @foreach ($users as $user)
                        <div
                            class="flex items-center justify-between rounded-lg border border-gray-200 px-5 py-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                    <span class="ml-2 text-xs text-gray-400">({{ $user->role }})</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <form action="{{ route('users.promote', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                        Promote
                                    </button>
                                </form>

                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this user and all their associated data? This action cannot be undone.');"
                                        class="px-4 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        Delete
                                    </button>

                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </body>
</x-layout>