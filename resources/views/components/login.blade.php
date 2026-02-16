<div class="flex-1 flex items-center justify-center text-center">
    <div class="flex flex-col border-2 border-gray-300 rounded-lg p-8 bg-white shadow-lg">
        <form method="POST" action="/login">
            @csrf
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-2xl font-black tracking-tight text-gray-800">AirBNB <span
                    class="text-red-500">Laravel</span></h1>
            <h3 class="text-sm text-gray-500 font-medium">Enjoy your stay!</h3>

            <div class="flex flex-col gap-4 mt-6">
                <div class="flex flex-col gap-1">
                    <label class="text-left text-xs font-bold uppercase tracking-wider text-gray-600">Email
                        Address</label>
                    <input name="email"
                        class="border-2 border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-red-500 transition-colors"
                        type="email" placeholder="you@example.com">
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-left text-xs font-bold uppercase tracking-wider text-gray-600">Password</label>
                    <input name="password"
                        class="border-2 border-gray-200 rounded-lg px-3 py-2 outline-none focus:border-red-500 transition-colors"
                        type="password" placeholder="••••••••">
                    @error('password')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <button
                    class="bg-red-500 hover:bg-red-600 active:scale-95 transform transition text-white font-bold py-3 rounded-xl mt-2 shadow-md shadow-red-100">
                    Sign in
                </button>

                <a href="/register" class="text-sm text-gray-600 hover:text-gray-800 transition">
                    Don't have an account? <span class="text-red-500 font-bold ml-1">Sign up</span>
                </a>
            </div>
        </form>
    </div>
</div>