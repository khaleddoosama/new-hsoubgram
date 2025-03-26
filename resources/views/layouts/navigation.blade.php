<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home_page') }}">
                        <x-application-logo class="block w-32 h-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home_page')" :active="request()->routeIs('home_page')">
                        {{ __('Home') }}
                    </x-nav-link>

                </div>

            </div>
            <div class="hidden sm:flex sm:items-center">
                <livewire:search />
            </div>
            {{-- Home --}}
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <div class="hidden md:flex md:flex-row space-x-3 items-center justify-center">
                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>

                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endguest
                    @auth
                        <a class="text-[1.6rem] rtl:ml-3" href="{{ route('home_page') }}">
                            {!! url()->current() == route('home_page')
                                ? '<i class="bx bxs-home-alt-2"></i>'
                                : '<i class="bx bx-home-alt-2"></i>' !!}
                        </a>

                        {{-- Explore --}}
                        <a class="text-[1.6rem]" href="{{ route('explore') }}">
                            {!! url()->current() == route('explore') ? '<i class="bx bxs-compass"></i>' : '<i class="bx bx-compass"></i>' !!}
                        </a>

                        {{-- Create Post --}}


                        <button onclick="Livewire.dispatch('openModal', { component: 'create-post-modal'})">
                            <i class="bx bx-message-square-add text-[1.6rem]"></i>
                        </button>

                        <x-slot name="content">
                        </x-slot>
                        <div class="hidden md:block relative">
                            <!-- Dropdown Toggle -->
                            <button id="followersDropdownTrigger" class="text-[1.6rem] ltr:mr-2 rtl:ml-2 leading-5">
                                <div class="relative">
                                    <i class="bx bxs-inbox"></i>
                                    <livewire:pending-followers-count />
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="followersDropdownMenu"
                                class="absolute right-0 mt-2 w-96 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                                <div class="py-1">
                                    <livewire:pending-followers-list />
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript for Dropdown -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const dropdownTrigger = document.getElementById("followersDropdownTrigger");
                                const dropdownMenu = document.getElementById("followersDropdownMenu");

                                dropdownTrigger.addEventListener("click", function(event) {
                                    event.stopPropagation();
                                    dropdownMenu.classList.toggle("hidden");
                                });

                                document.addEventListener("click", function() {
                                    dropdownMenu.classList.add("hidden");
                                });

                                dropdownMenu.addEventListener("click", function(event) {
                                    event.stopPropagation();
                                });
                            });
                        </script>

                        <div class="hidden md:block relative">
                            <!-- Dropdown Toggle -->
                            <button id="dropdownTrigger"
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                <div>
                                    <img class="w-6 h-6 -mt-1 object-cover rounded-full border border-gray-500"
                                        src="{{ Str::startsWith(Auth::user()->image, 'https') ? Auth::user()->image : asset('storage/' . Auth::user()->image) }}">
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="dropdownMenu"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden">
                                <div class="py-1">
                                    <!-- Profile Link -->
                                    <a href="{{ route('userprofile', auth()->user()) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Profile') }}
                                    </a>

                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript to Handle Dropdown -->
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const dropdownTrigger = document.getElementById("dropdownTrigger");
                                const dropdownMenu = document.getElementById("dropdownMenu");

                                dropdownTrigger.addEventListener("click", function(event) {
                                    event.stopPropagation();
                                    dropdownMenu.classList.toggle("hidden");
                                });

                                document.addEventListener("click", function() {
                                    dropdownMenu.classList.add("hidden");
                                });

                                dropdownMenu.addEventListener("click", function(event) {
                                    event.stopPropagation();
                                });
                            });
                        </script>


                    </div>




                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home_page')" :active="request()->routeIs('home_page')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    @endauth

</nav>
