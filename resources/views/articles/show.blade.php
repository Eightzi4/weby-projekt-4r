@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <article class="max-w-4xl mx-auto">
        <header class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-800 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Zpět na přehled
            </a>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                {{ $article->title }}
            </h1>
            <p class="mt-3 text-lg text-gray-500">
                Publikováno: {{ $article->date->format('j. n. Y') }}
            </p>
        </header>

        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-200">
            <img class="w-full h-72 md:h-[450px] object-cover"
                 src="{{ asset('storage/images/articles/' . $article->photo) }}"
                 alt="{{ $article->title }}">

            <div class="p-6 md:p-10">
                <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                    {!! $article->text !!}
                </div>
            </div>
        </div>
    </article>

    <style>
        .prose iframe {
            width: 100%;
            aspect-ratio: 16 / 9;
            border-radius: 0.75rem; /* .rounded-xl */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); /* .shadow-md */
        }
    </style>
@endsection
