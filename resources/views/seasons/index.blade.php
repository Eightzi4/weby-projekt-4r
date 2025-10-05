@extends('layouts.app')

@section('title', 'Přehled sezón')

@section('content')
    <header class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-800">Přehled sezón</h1>
        <p class="mt-2 text-lg text-gray-600">Prozkoumejte historii zápasů a výsledků.</p>
    </header>

    @if($seasons->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($seasons as $season)
                <a href="{{ route('seasons.show', $season) }}"
                   class="group flex flex-col h-full bg-white rounded-xl shadow-lg hover:shadow-2xl transform transition-all duration-300 border border-gray-200">

                    <div class="p-6 border-b-2 border-indigo-500">
                        <h2 class="text-2xl font-bold text-gray-900 text-center">
                            Sezóna {{ $season->start }}/{{ $season->finish }}
                        </h2>
                    </div>

                    <div class="p-6 flex-grow">
                        @if($season->leagues->isNotEmpty())
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Soutěže:</h3>
                            <ul class="space-y-2 text-gray-700">
                                @foreach($season->leagues as $league)
                                    <li class="flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-indigo-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>{{ $league->name }} <span class="text-gray-500">(Úroveň: {{ $league->level }})</span></span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="flex-grow flex items-center justify-center h-full">
                                <p class="text-sm text-gray-500">Žádné soutěže pro tuto sezónu.</p>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $seasons->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <h3 class="mt-2 text-lg font-medium text-gray-900">Nebyly nalezeny žádné sezóny</h3>
            <p class="mt-1 text-sm text-gray-500">Zkuste to prosím znovu později.</p>
        </div>
    @endif
@endsection
