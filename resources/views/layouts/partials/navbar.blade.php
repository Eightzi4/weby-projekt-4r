{{-- x-data="{ open: false }" inicializuje Alpine.js komponentu s proměnnou 'open' --}}
<nav x-data="{ mobileMenuOpen: false, adminDropdownOpen: false }" class="bg-gray-800 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- Logo / Název webu -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                    Klubový web
                </a>
            </div>

            <!-- Primární navigace (Desktop) -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @if(isset($frontendNavItems))
                    @foreach($frontendNavItems as $item)
                        <a href="{{ route($item->route) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ $item->title }}</a>
                    @endforeach
                @endif
            </div>

            <!-- Pravá část (Administrace) -->
            <div class="hidden md:block">
                @auth
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Administrace Dropdown -->
                        <div class="relative">
                            <div>
                                <button @click="adminDropdownOpen = !adminDropdownOpen" type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    Administrace
                                    <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            {{-- Obsah dropdownu --}}
                            <div x-show="adminDropdownOpen"
                                 @click.away="adminDropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                 style="display: none;">

                                @if(isset($adminNavItems))
                                    @foreach($adminNavItems as $item)
                                        <a href="{{ route($item->route) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">{{ $item->title }}</a>
                                    @endforeach
                                @endif
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Odhlásit
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Hamburger tlačítko (Mobil) -->
            <div class="-mr-2 flex md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Otevřít menu</span>
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobilní menu -->
    <div x-show="mobileMenuOpen" class="md:hidden" id="mobile-menu" style="display: none;">
        <div class="space-y-1 px-2 pb-3 pt-2">
            @if(isset($frontendNavItems))
                @foreach($frontendNavItems as $item)
                    <a href="{{ route($item->route) }}" class="block text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium">{{ $item->title }}</a>
                @endforeach
            @endif
        </div>

        <!-- Administrace v mobilním menu -->
        @auth
            <div class="border-t border-gray-700 pb-3 pt-4">
                <div class="flex items-center px-5">
                    <div class="text-base font-medium leading-none text-white">Administrace</div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    @if(isset($adminNavItems))
                        @foreach($adminNavItems as $item)
                            <a href="{{ route($item->route) }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">{{ $item->title }}</a>
                        @endforeach
                    @endif
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                       class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">
                        Odhlásit
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        @endauth
    </div>
</nav>