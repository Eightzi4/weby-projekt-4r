<nav x-data="{ mobileMenuOpen: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEVÁ ČÁST -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="shrink-0 flex items-center text-xl font-bold text-gray-800">
                    Klubový web
                </a>
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    @if(isset($leftNavItems))
                        @foreach($leftNavItems as $item)
                            @php
                                $isActive = request()->routeIs($item->route);
                                $classes = $isActive
                                    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-semibold leading-5 text-gray-900 transition'
                                    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition';
                            @endphp

                            @if($item->requires_auth)
                                @auth
                                    <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                                @endauth
                            @else
                                <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- PRAVÁ ČÁST -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-8">
                @if(isset($rightNavItems))
                    @foreach($rightNavItems as $item)
                        @php
                            $isActive = request()->routeIs($item->route) || request()->routeIs(str_replace('.index', '.*', $item->route));
                            $classes = $isActive
                                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-semibold leading-5 text-gray-900 transition'
                                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition';
                        @endphp

                        @if($item->requires_auth)
                            @auth
                                <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                            @endauth
                        @else
                            <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                        @endif
                    @endforeach
                @endif

                @auth
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition">Odhlásit</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('login') ? 'border-indigo-500 text-gray-900 font-semibold' : 'border-transparent text-gray-500' }} hover:text-gray-700 hover:border-gray-300 text-sm font-medium leading-5 transition">Přihlásit</a>
                @endguest
            </div>

            <!-- Hamburger (zůstává stejný) -->
            <div class="-mr-2 flex items-center sm:hidden">
                 <button @click="mobileMenuOpen = ! mobileMenuOpen" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': mobileMenuOpen, 'inline-flex': ! mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (isset($leftNavItems))
                @foreach ($leftNavItems as $item)
                    @php
                        $isActive = request()->routeIs($item->route);
                        $classes = $isActive
                            ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-500 bg-indigo-50 text-indigo-700 font-semibold'
                            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800';
                    @endphp

                    @if($item->requires_auth)
                        @auth
                            <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                        @endauth
                    @else
                         <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                    @endif
                @endforeach
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="space-y-1">
                @if (isset($rightNavItems))
                    @foreach ($rightNavItems as $item)
                        @php
                            $isActive = request()->routeIs($item->route) || request()->routeIs(str_replace('.index', '.*', $item->route));
                            $classes = $isActive
                                ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-500 bg-indigo-50 text-indigo-700 font-semibold'
                                : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800';
                        @endphp

                        @if($item->requires_auth)
                            @auth
                                <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                            @endauth
                        @else
                            <a href="{{ route($item->route) }}" class="{{ $classes }}">{{ $item->title }}</a>
                        @endif
                    @endforeach
                @endif

                @auth
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Odhlásit</a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Přihlásit</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
