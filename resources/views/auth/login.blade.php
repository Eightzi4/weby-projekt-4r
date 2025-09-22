@extends('layouts.app')

@section('title', 'Přihlášení')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-150px)]">
    <div class="w-full max-w-md">

        <form class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
            @csrf

            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Přihlášení do administrace</h1>

            {{-- E-mailová adresa --}}
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                    E-mailová adresa
                </label>
                <input id="email" type="email"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Heslo --}}
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                    Heslo
                </label>
                <input id="password" type="password"
                       class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            {{-- Zapamatovat si --}}
            <div class="mb-6">
                <div class="flex items-center">
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="ml-2 block text-sm text-gray-900" for="remember">
                        Zapamatovat si mě
                    </label>
                </div>
            </div>


            <div class="flex items-center justify-between">
                {{-- Tlačítko Přihlásit --}}
                <button type="submit"
                        class="w-full bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                    Přihlásit
                </button>
            </div>

            {{-- Zapomenuté heslo (volitelné) --}}
            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a class="inline-block align-baseline font-bold text-sm text-gray-600 hover:text-gray-800" href="{{ route('password.request') }}">
                        Zapomněli jste heslo?
                    </a>
                </div>
            @endif
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;{{ date('Y') }} Všechna práva vyhrazena.
        </p>
    </div>
</div>
@endsection