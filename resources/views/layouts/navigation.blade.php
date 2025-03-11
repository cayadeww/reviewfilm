<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-600 to-pink-600 border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex  justify-between h-16">
            <div class="flex">
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    @if(Auth::check() && Auth::user()->role == 'admin')
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.author.index') }}" :active="request()->routeIs('admin.author.index')">
                            {{ __('Kelola Author') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.user.index') }}" :active="request()->routeIs('admin.user.index')">
                            {{ __('Kelola Subscriber') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.film.index') }}" :active="request()->routeIs('admin.film.index')">
                            {{ __('Kelola Film') }}
                        </x-nav-link>
                    @elseif(Auth::check() && Auth::user()->role == 'author')
                        <x-nav-link href="{{ route('author.dashboard') }}" :active="request()->routeIs('author.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('author.film') }}" :active="request()->routeIs('author.film')">
                            {{ __('Data Film') }}
                        </x-nav-link>
                    @elseif(Auth::check() && Auth::user()->role == 'user')
                        <x-nav-link href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')">
                            {{ __('Review Film') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden -ml-[1000px] space-x-8 sm:-my-px sm:flex ">
                @guest
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Review Film') }}
                    </x-nav-link>
                @endguest
            </div>
            
            <div class="flex items-center space-x-4">
                @guest
                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')" class="text-white">
                        {{ __('Login') }}
                    </x-nav-link>
                    @if (Route::has('register'))
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')" class="text-white">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endif
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-pink hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>
        </div>
    </div>
</nav>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        {{-- <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div> --}}
{{-- 
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}
</nav>
