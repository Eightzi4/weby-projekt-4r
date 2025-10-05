@extends('layouts.app')

@section('title', 'Zápasy sezóny ' . $season->start . '/' . $season->finish)

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Zápasy sezóny {{ $season->start }}/{{ $season->finish }}
        </h1>
        {{-- Tlačítko pro návrat na přehled všech sezón --}}
        <a href="{{ route('seasons.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-md transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Zpět na přehled sezón
        </a>
    </div>

    @if($gamesByRound->isNotEmpty())
        <div class="space-y-8">
            {{-- Projdeme kolekci seskupenou podle kol --}}
            @foreach($gamesByRound as $round => $games)
                <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold text-gray-900 border-b-2 border-indigo-500 pb-3 mb-4">
                        Kolo {{ $round }}
                    </h2>
                    <div class="divide-y divide-gray-200">
                        {{-- Projdeme všechny zápasy v daném kole --}}
                        @foreach($games as $game)
                            <a href="{{ route('games.show', $game) }}" class="flex items-center justify-between py-4 text-lg hover:bg-gray-50 -mx-4 sm:-mx-6 px-4 sm:px-6 transition-colors duration-200">
                                {{-- Domácí tým --}}
                                <span class="text-right w-2/5 font-medium text-gray-800 truncate pr-2">
                                    {{ $game->homeTeam->name ?? 'Domácí Tým' }}
                                </span>

                                {{-- Skóre --}}
                                <div class="font-bold text-center w-1/5 bg-gray-900 text-white px-2 py-1 rounded-md text-xl tracking-wider">
                                    <span>{{ $game->goals_home }}</span>
                                    <span class="mx-1">:</span>
                                    <span>{{ $game->goals_away }}</span>
                                </div>

                                {{-- Hostující tým --}}
                                <span class="text-left w-2/5 font-medium text-gray-800 truncate pl-2">
                                    {{ $game->awayTeam->name ?? 'Hostující Tým' }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <p class="text-gray-600">Pro tuto sezónu nebyly nalezeny žádné zápasy.</p>
        </div>
    @endif
@endsection