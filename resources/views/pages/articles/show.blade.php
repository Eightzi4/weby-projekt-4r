@extends('layouts.app')

{{-- Nastavíme titulek stránky na název článku --}}
@section('title', $article->title)

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-md">

        {{-- HLAVNÍ NADPIS ČLÁNKU --}}
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
            {{ $article->title }}
        </h1>

        {{-- DATUM PUBLIKACE --}}
        <p class="text-gray-500 mb-6">
            Publikováno: {{ $article->date->format('j. n. Y') }}
        </p>

        {{-- HLAVNÍ OBRÁZEK ČLÁNKU --}}
        <img class="w-full rounded-lg mb-8" src="{{ asset('storage/images/articles/' . $article->photo) }}"
            alt="{{ $article->title }}">

        {{-- TEXT ČLÁNKU - Vykreslení HTML --}}
        <div class="prose max-w-none">
            {!! $article->text !!}
        </div>

    </div>

    {{-- ======================================================== --}}
    {{-- ==== ZDE JE PŘIDANÝ KÓD PRO OPRAVU RESPONZIVNÍCH VIDEÍ ==== --}}
    {{-- ======================================================== --}}
    <style>
        /* Zaměříme se na všechny iframe prvky, které jsou uvnitř kontejneru s třídou .prose */
        .prose iframe {
            width: 100%;            /* iframe bude vždy na 100% šířky svého rodiče */
            aspect-ratio: 16 / 9;   /* Udrží poměr stran 16:9 (standard pro YouTube) */
            border-radius: 0.5rem;  /* Přidáme zaoblené rohy, aby ladil s designem (odpovídá .rounded-lg) */
        }
    </style>
    {{-- ======================================================== --}}
    {{-- ================ KONEC PŘIDANÉHO KÓDU ==================== --}}
    {{-- ======================================================== --}}

@endsection