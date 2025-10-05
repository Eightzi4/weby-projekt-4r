@extends('layouts.app')

@section('title', 'Zápasy sezóny ' . $season->start . '/' . $season->finish)

@section('content')
    <header class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Zápasy sezóny {{ $season->start }}/{{ $season->finish }}</h1>
                <p class="mt-2 text-lg text-gray-600">Přehled všech odehraných kol a jejich výsledků.</p>
            </div>
            <a href="{{ route('seasons.index') }}" class="hidden sm:inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-800 text-sm font-medium rounded-md transition-colors duration-200 shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Zpět na přehled sezón
            </a>
        </div>
    </header>

    @if($gamesByRound->isNotEmpty())
        <div class="space-y-10">
            @foreach($gamesByRound as $round => $games)
                <section>
                    <h2 class="text-2xl font-semibold text-gray-800 pb-3 mb-4 border-b-2">Kolo {{ $round }}</h2>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                        <div class="divide-y divide-gray-200">
                            @foreach($games as $game)
                                @php
                                    if ($game->goals_home > $game->goals_away) {
                                        $home_class = 'border-l-4 border-green-500 bg-green-50';
                                        $away_class = 'border-l-4 border-red-500';
                                    } elseif ($game->goals_away > $game->goals_home) {
                                        $home_class = 'border-l-4 border-red-500';
                                        $away_class = 'border-l-4 border-green-500 bg-green-50';
                                    } else {
                                        $home_class = 'border-l-4 border-gray-300';
                                        $away_class = 'border-l-4 border-gray-300';
                                    }
                                @endphp

                                <a href="{{ route('games.show', $game) }}" class="grid grid-cols-5 gap-4 items-center py-4 px-6 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="col-span-2 flex justify-end items-center {{ $home_class }} pr-4 h-full">
                                        <span class="font-semibold text-gray-800 text-right">{{ $game->homeTeam->name ?? 'Domácí Tým' }}</span>
                                    </div>

                                    <div class="col-span-1 text-center font-bold text-2xl text-gray-800">
                                        <span>{{ $game->goals_home }}</span>
                                        <span class="mx-1 text-gray-400">:</span>
                                        <span>{{ $game->goals_away }}</span>
                                    </div>

                                    <div class="col-span-2 flex items-center {{ $away_class }} pl-4 h-full">
                                        <span class="font-semibold text-gray-800 text-left">{{ $game->awayTeam->name ?? 'Hostující Tým' }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <h3 class="mt-2 text-lg font-medium text-gray-900">Pro tuto sezónu nebyly nalezeny žádné zápasy.</h3>
        </div>
    @endif
@endsection
