@extends('layouts.app')

@section('title', 'Úvodní stránka')

@section('content')
    @if(isset($articles) && $articles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($articles as $article)

                @if($loop->first)
                    {{-- VELKÁ DLAŽDICE --}}
                    <a href="{{ route('articles.show', $article) }}"
                       class="group block rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden
                              lg:col-span-2 lg:row-span-2">
                        <div class="relative h-full">
                            {{-- KLÍČOVÁ ZMĚNA ZDE: Přidali jsme 'absolute inset-0' a 'h-full' --}}
                            <img class="absolute inset-0 w-full h-full object-cover"
                                 src="{{ asset('storage/images/articles/' . $article->photo) }}"
                                 alt="{{ $article->title }}">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

                            <div class="absolute bottom-0 left-0 p-6">
                                <h2 class="text-white text-3xl font-bold leading-tight">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-gray-200 text-sm mt-2">
                                    {{ $article->date->format('j. n. Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @else
                    {{-- MALÁ DLAŽDICE --}}
                    <a href="{{ route('articles.show', $article) }}" class="group block rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        {{-- Rodičovský DIV musí být 'relative' a mít definovanou výšku --}}
                        <div class="relative h-48">
                            {{-- STEJNÁ KLÍČOVÁ ZMĚNA ZDE: --}}
                            <img class="absolute inset-0 w-full h-full object-cover"
                                 src="{{ asset('storage/images/articles/' . $article->photo) }}"
                                 alt="{{ $article->title }}">

                            <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all duration-300"></div>

                            <div class="absolute bottom-0 left-0 p-4">
                                <h2 class="text-white text-xl font-bold leading-tight">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-gray-200 text-sm mt-1">
                                    {{ $article->date->format('j. n. Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endif

            @endforeach

        </div>
    @else
        <div class="p-6 bg-white border-b border-gray-200 rounded-lg shadow-sm text-center">
            <p class="text-gray-600">Nebyly nalezeny žádné články k zobrazení.</p>
        </div>
    @endif
@endsection
