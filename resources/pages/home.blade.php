@extends('layouts.app')

@section('title', 'Úvodní stránka')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Nejnovější články</h1>

    {{-- Zde bude mřížka s dlaždicemi článků --}}
    <div class="p-6 bg-white border-b border-gray-200 rounded-lg shadow-sm">
        <p>Obsah úvodní stránky se zde zobrazí, jakmile načteme články z databáze.</p>
    </div>
@endsection