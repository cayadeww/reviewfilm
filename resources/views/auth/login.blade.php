<x-guest-layout>
    <h2 class="text-center text-xl font-bold text-gray-700 mb-4">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <span class="text-purple-500 pr-2">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" class="w-full focus:outline-none" type="email" name="email" placeholder="Enter your email" required autofocus />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <div class="flex items-center border-b border-gray-300 py-2">
                        <span class="text-purple-500 pr-2">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" class="w-full focus:outline-none" type="password" name="password" placeholder="Enter your password" required />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Forgot Password -->
                <div class="text-right mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-purple-500 text-sm hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mb-4">
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg">
                        Login
                    </button>
                </div>

                <!-- Signup Link -->
                <div class="text-center text-sm">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-purple-500 hover:underline">Signup now</a>
                </div>
            </form>
</x-guest-layout>
