<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-8">
        <div class="flex justify-between h-14">
            <div class="flex w-[60%] items-center justify-between">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a class="flex items-center gap-x-2" href="{{ route('dashboard') }}">
                        <img src ="{{ asset('gdrive.png') }}" class="w-8 h-8" alt="img"/>
                        <p class="text-gray-500 text-lg">Drive</p>
                    </a>
                </div>
                <div class="w-[75%]">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Search in Drive</label>
                        <div class="relative w-full">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>

                            <input type="text" id="simple-search" class="bg-gray-100 text-gray-600 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  " placeholder="Search in Drive" required>

                            <div class="flex absolute inset-y-0 right-0 items-center pr-3 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                                  </svg>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center">
                <div class="">

                    <div class="flex items-center gap-x-4">
                        <x-qmark/>
                        <x-setting/>
                    </div>
                </div>
                <div class="">
                    <div class="hidden sm:flex sm:items-center justify-between rounded-xl w-[100px] px-2 py-1 bg-gray-200  sm:ml-6">
                        <div class="">
                            <x-sixdots/>
                        </div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>
                                         @if(isset(Auth::user()->userPhoto)  )
                                        <img
                                        class="w-8 h-8 rounded-[100%] object-cover"
                                        src="{{ asset('storage/'.Auth::user()->name.'/'.Auth::user()->userPhoto) }}" alt="no photo">
                                        @else
                                         <div class="w-7 h-7 rounded-full bg-green-800 flex items-center justify-center text-white">
                                            <p>{{ Str::ucfirst(Str::substr(Auth::user()->name,0,1))  }}</p>
                                         </div>
                                        @endif
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
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
</nav>
