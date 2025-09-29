@extends('layouts.app')

@section('title', 'Detail zápasu')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">

        {{-- Týmy a skóre --}}
        <div class="flex justify-around items-center mb-6">
            {{-- Domácí tým --}}
            <div class="flex flex-col items-center w-1/3">
                <img src="{{ asset('storage/images/logos/' . ($game->homeTeam->logo ?? 'placeholder.png')) }}"
                    alt="{{ $game->homeTeam->name ?? 'Domácí' }}" class="h-24 mb-2">
                <h2 class="text-2xl font-bold text-center">{{ $game->homeTeam->name ?? 'Domácí Tým' }}</h2>
            </div>

            {{-- Skóre --}}
            <div class="text-center w-1/3">
                <p class="text-5xl font-extrabold">{{ $game->goals_home }} : {{ $game->goals_away }}</p>
                <p class="text-gray-600 text-lg mt-1">(Poločas: {{ $game->ht_goals_home }}:{{ $game->ht_goals_away }})</p>
            </div>

            {{-- Hostující tým --}}
            <div class="flex flex-col items-center w-1/3">
                <img src="{{ asset('storage/images/logos/' . ($game->awayTeam->logo ?? 'placeholder.png')) }}"
                    alt="{{ $game->awayTeam->name ?? 'Hosté' }}" class="h-24 mb-2">
                <h2 class="text-2xl font-bold text-center">{{ $game->awayTeam->name ?? 'Hostující Tým' }}</h2>
            </div>
        </div>

        {{-- Doplňující informace --}}
        <div class="border-t pt-6 text-lg">
            <ul class="space-y-2 text-gray-700">

                {{-- Zobrazíme řádek s datem, pouze pokud je datum k dispozici (není NULL) --}}
                @if ($game->has_valid_date)
                    <li class="flex justify-between">
                        <strong class="mr-2">Datum:</strong>
                        <span>{{ $game->date->format('j. n. Y') }}
                            @if ($game->time)
                                , {{ \Carbon\Carbon::parse($game->time)->format('H:i') }}
                            @else
                                <span class="text-gray-500 text-base ml-1">(čas neznámý)</span>
                            @endif
                        </span>
                    </li>
                @endif

                {{-- Zobrazíme řádek se stadionem, pouze pokud není NULL --}}
                @if ($game->stadium)
                    <li class="flex justify-between">
                        <strong class="mr-2">Stadion:</strong>
                        <span>{{ $game->stadium }}</span>
                    </li>
                @endif

                {{-- Počet diváků se zobrazí vždy (i pokud je 0) --}}
                <li class="flex justify-between">
                    <strong class="mr-2">Počet diváků:</strong>
                    <span>{{ number_format($game->attendance, 0, ',', ' ') }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection
