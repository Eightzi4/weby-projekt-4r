@extends('layouts.app')

@section('title', 'Klubový web')

@section('content')
    <header class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-gray-800">Nejnovější články</h1>
        <p class="mt-2 text-lg text-gray-600">Aktuální dění z našeho klubu.</p>
    </header>

    @if(isset($articles) && $articles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($articles as $article)

                @if($loop->first)
                    <a href="{{ route('articles.show', $article) }}"
                       class="group block rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden
                              lg:col-span-2 lg:row-span-2 border border-gray-200">
                        <div class="relative h-full">
                            <img class="absolute inset-0 w-full h-full object-cover"
                                 src="{{ asset('storage/images/articles/' . $article->photo) }}"
                                 alt="{{ $article->title }}">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

                            <div class="absolute bottom-0 left-0 p-6">
                                <h2 class="text-white text-3xl font-bold leading-tight [text-shadow:0_1px_3px_rgba(0,0,0,0.5)]">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-gray-200 text-sm mt-2">
                                    {{ $article->date->format('j. n. Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ route('articles.show', $article) }}" class="group block rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-200">
                        <div class="relative h-48">
                            <img class="absolute inset-0 w-full h-full object-cover"
                                 src="{{ asset('storage/images/articles/' . $article->photo) }}"
                                 alt="{{ $article->title }}">

                            <div class="absolute inset-0 bg-black bg-opacity-60 group-hover:bg-opacity-50 transition-all duration-300"></div>

                            <div class="absolute bottom-0 left-0 p-4">
                                <h2 class="text-white text-xl font-bold leading-tight [text-shadow:0_1px_3px_rgba(0,0,0,0.4)]">
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
        <div class="text-center py-12">
            <h3 class="mt-2 text-lg font-medium text-gray-900">Nebyly nalezeny žádné články</h3>
            <p class="mt-1 text-sm text-gray-500">Zkuste to prosím znovu později.</p>
        </div>
    @endif
@endsection
