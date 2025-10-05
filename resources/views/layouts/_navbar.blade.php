<nav x-data="{ mobileMenuOpen: false }" class="bg-gray-800 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">

            <!-- Levá část (Logo a Veřejné menu) -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">
                    Klubový web
                </a>
                <div class="hidden md:flex md:items-center md:ml-10 md:space-x-4">
                    @if(isset($frontendNavItems))
                        @foreach($frontendNavItems as $item)
                            <a href="{{ route($item->route) }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ $item->title }}</a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Pravá část (Admin menu / Přihlášení) -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @auth
                    @if(isset($adminNavItems))
                        @foreach($adminNavItems as $item)
                            @php
                                // Zjistíme, zda je aktuální routa aktivní
                                $isActive = request()->routeIs($item->route) || request()->routeIs(str_replace('.index', '.*', $item->route));
                                // Podle toho nastavíme CSS třídy
                                $classes = $isActive
                                    ? 'bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium'
                                    : 'text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium';
                            @endphp
                            <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                        @endforeach
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Odhlásit</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Přihlásit</a>
                @endguest
            </div>

            <!-- Hamburger tlačítko (Mobil) -->
            <div class="-mr-2 flex md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none">
                    <span class="sr-only">Otevřít menu</span>
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobilní menu -->
    <div x-show="mobileMenuOpen" class="md:hidden" id="mobile-menu" style="display: none;">
        <div class="space-y-1 px-2 pb-3 pt-2">
            @if(isset($frontendNavItems))
                @foreach($frontendNavItems as $item)
                    <a href="{{ route($item->route) }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">{{ $item->title }}</a>
                @endforeach
            @endif
        </div>

        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="space-y-1 px-2">
                @auth
                    @if(isset($adminNavItems))
                        @foreach($adminNavItems as $item)
                             @php
                                $isActive = request()->routeIs($item->route) || request()->routeIs(str_replace('.index', '.*', $item->route));
                                $classes = $isActive
                                    ? 'bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium'
                                    : 'text-gray-400 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium';
                            @endphp
                            <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                        @endforeach
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Odhlásit</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Přihlásit</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
