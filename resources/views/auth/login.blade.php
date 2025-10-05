@extends('layouts.app')

@section('title', 'Přihlášení')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg border border-gray-200">

        <h1 class="text-center text-3xl font-bold text-gray-800 mb-6">
            Přihlášení do administrace
        </h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">E-mailová adresa</label>
                <input id="email" type="email"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Heslo</label>
                <input id="password" type="password"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror"
                       name="password" required autocomplete="current-password">

                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">Zapamatovat si mě</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-6">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        Zapomněli jste heslo?
                    </a>
                @endif

                <button type="submit"
                        class="ml-4 inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Přihlásit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
