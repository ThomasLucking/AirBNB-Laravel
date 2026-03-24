<x-layout title="Edit User">

    <body class="font-sans bg-gray-50 text-gray-900 flex">
        <main class="flex-1 flex flex-col items-center justify-center min-h-screen p-8">
            <div class="w-full max-w-xl space-y-6 bg-white p-8 rounded-xl shadow-sm border-2 border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Edit User</h2>
                    <p class="text-gray-500">Update the credentials of the user.</p>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="flex-row space-y-4">
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
                        <x-input-bar placeholder="Name" name="name" :value="old('name', $user->name)" />
                        <x-input-bar placeholder="Email" type="email" name="email" :value="old('email', $user->email)" />
                        <x-input-bar placeholder="New Password" type="password" name="password" />
                        <x-input-bar placeholder="Confirm New Password" type="password" name="password_confirmation" />
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200">
                        Save Changes
                    </button>
                </form>
            </div>
        </main>
    </body>
</x-layout>