<x-guest-layout>
        <h2 class="text-center text-xl font-bold text-gray-700 mb-4">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <div class="flex items-center border border-gray-300 rounded-lg p-2">
                    <span class="text-purple-500 pr-2">
                        <i class="fas fa-user"></i>
                    </span>
                    <input id="name" class="w-full focus:outline-none" type="text" name="name" placeholder="Full Name" required autofocus />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <div class="flex items-center border border-gray-300 rounded-lg p-2">
                    <span class="text-purple-500 pr-2">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input id="email" class="w-full focus:outline-none" type="email" name="email" placeholder="Enter your email" required />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <div class="flex items-center border border-gray-300 rounded-lg p-2">
                    <span class="text-purple-500 pr-2">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="password" class="w-full focus:outline-none" type="password" name="password" placeholder="Enter your password" required />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <div class="flex items-center border border-gray-300 rounded-lg p-2">
                    <span class="text-purple-500 pr-2">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input id="password_confirmation" class="w-full focus:outline-none" type="password" name="password_confirmation" placeholder="Confirm your password" required />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <!-- Register Button -->
            <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg">
                Register
            </button>

            <!-- Login Link -->
            <div class="text-center text-sm mt-4">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-purple-500 hover:underline">Login now</a>
            </div>
        </form>
    </div>
</x-guest-layout>
