@extends('layouts.app')

@section('title', 'Detail zápasu')

@section('content')
    <div class="max-w-4xl mx-auto">
        <header class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-800 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Zpět na přehled zápasů
            </a>
            @if($game->has_valid_date)
                <p class="text-center text-gray-500">{{ $game->date->format('j. n. Y') }}</p>
            @endif
            <h1 class="text-4xl font-bold text-gray-800 text-center">Detail zápasu</h1>
        </header>

        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-200">
            <div class="p-8 bg-gray-900 text-white">
                <div class="flex justify-around items-center">
                    <div class="flex flex-col items-center text-center w-1/3">
                        <img src="{{ asset('storage/images/logos/' . ($game->homeTeam->logo ?? 'placeholder.png')) }}" alt="{{ $game->homeTeam->name ?? 'Domácí' }}" class="h-28 mb-3">
                        <h2 class="text-2xl font-bold">{{ $game->homeTeam->name ?? 'Domácí Tým' }}</h2>
                    </div>

                    <div class="text-center w-1/3">
                        <p class="text-6xl font-black">{{ $game->goals_home }} : {{ $game->goals_away }}</p>
                        <p class="text-gray-300 text-lg mt-1">(Poločas: {{ $game->ht_goals_home }}:{{ $game->ht_goals_away }})</p>
                    </div>

                    <div class="flex flex-col items-center text-center w-1/3">
                        <img src="{{ asset('storage/images/logos/' . ($game->awayTeam->logo ?? 'placeholder.png')) }}" alt="{{ $game->awayTeam->name ?? 'Hosté' }}" class="h-28 mb-3">
                        <h2 class="text-2xl font-bold">{{ $game->awayTeam->name ?? 'Hostující Tým' }}</h2>
                    </div>
                </div>
            </div>

            <div class="p-8 border-t border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Informace o zápasu</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-gray-700">
                    @if($game->has_valid_date && $game->time)
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Čas výkopu</dt>
                            <dd class="mt-1 text-lg font-semibold">{{ \Carbon\Carbon::parse($game->time)->format('H:i') }}</dd>
                        </div>
                    @endif
                    @if($game->stadium)
                        <div class="flex flex-col">
                            <dt class="text-sm font-medium text-gray-500">Stadion</dt>
                            <dd class="mt-1 text-lg font-semibold">{{ $game->stadium }}</dd>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <dt class="text-sm font-medium text-gray-500">Počet diváků</dt>
                        <dd class="mt-1 text-lg font-semibold">{{ number_format($game->attendance, 0, ',', ' ') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
