@extends('layouts.app')

@section('title', 'Sezóny')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Přehled sezón</h1>

    @if($seasons->isNotEmpty())
        {{--
            Použijeme Grid pro responzivní layout:
            - Na mobilech: 1 sloupec (grid-cols-1)
            - Na tabletech: 2 sloupce (md:grid-cols-2)
            - Na desktopech: 3 sloupce (lg:grid-cols-3)
            - gap-6 vytvoří mezeru mezi kartami
        --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($seasons as $season)
                {{-- Odkaz na detail sezóny --}}
                <a href="{{ route('seasons.show', $season) }}"
                   class="flex flex-col h-full p-6 bg-white rounded-lg shadow-md hover:shadow-xl hover:scale-105 transform transition-all duration-300">

                    {{-- Název sezóny (např. 2024/2025) --}}
                    <div class="border-b border-gray-200 pb-3 mb-3">
                        <h2 class="text-xl font-bold text-gray-900 text-center">
                            Sezóna {{ $season->start }}/{{ $season->finish }}
                        </h2>
                    </div>

                    {{-- Seznam soutěží v dané sezóně --}}
                    @if($season->leagues->isNotEmpty())
                        <div class="flex-grow"> {{-- Tento div zajistí, že obsah bude růst a patička (pokud by byla) bude dole --}}
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Soutěže:</h3>
                            <ul class="space-y-1 text-sm text-gray-700">
                                @foreach($season->leagues as $league)
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        <span>{{ $league->name }} (Úroveň: {{ $league->level }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="flex-grow flex items-center justify-center">
                            <p class="text-sm text-gray-500">Pro tuto sezónu nejsou k dispozici žádné soutěže.</p>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- Odkazy na další stránky --}}
        <div class="mt-8">
            {{ $seasons->links() }}
        </div>
    @else
        <p class="text-gray-600">Nebyly nalezeny žádné sezóny.</p>
    @endif
@endsection
