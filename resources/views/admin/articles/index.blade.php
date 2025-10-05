@extends('layouts.app')

@section('title', 'Správa článků')

@section('content')
<div x-data="{ deleteModalOpen: false, deleteUrl: '' }">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Správa článků</h1>
        <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Přidat článek</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Název</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stav</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Datum</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $article->title }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="{{ $article->published ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800' }} px-2 py-1 rounded-full text-xs">Publikováno</span>
                        <span class="{{ $article->top ? 'bg-blue-200 text-blue-800' : 'bg-gray-200 text-gray-800' }} px-2 py-1 rounded-full text-xs">Top</span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $article->date->format('d.m.Y') }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editovat</a>
                        <button @click="deleteUrl = '{{ route('admin.articles.destroy', $article) }}'; deleteModalOpen = true" class="text-red-600 hover:text-red-900">Smazat</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modální okno pro smazání -->
    <div x-show="deleteModalOpen" class="fixed z-10 inset-0 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all my-8">
                <div class="bg-white px-4 pt-5 pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Smazat článek</h3>
                    <p class="mt-2 text-sm text-gray-500">Opravdu si přejete smazat tento článek? Tuto akci nelze vrátit.</p>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form :action="deleteUrl" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700">Smazat</button>
                    </form>
                    <button @click="deleteModalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50">Zrušit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
