<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Fotbalový web')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    {{-- SMAŽTE NEBO ZAKOMENTUJTE TENTO ŘÁDEK:
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    --}}

    {{-- A MÍSTO NĚJ VLOŽTE TENTO: --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS pro interaktivitu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 font-sans text-gray-900 antialiased">
    <div id="app">

        @include('layouts.partials.navbar')

        <main class="py-8">
            <div class="container mx-auto px-4">
                @yield('content')
            </div>
        </main>

    </div>

    @stack('scripts')
</body>
</html>