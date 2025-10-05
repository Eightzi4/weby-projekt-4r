@extends('layouts.app')

@section('title', 'Přidat nový článek')

@section('content')
    <header class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Přidat nový článek</h1>
    </header>
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white shadow-xl rounded-xl border border-gray-200">
            <div class="p-6 sm:p-8">
                @include('admin.articles._form')
            </div>
            <div class="px-6 sm:px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Zrušit</a>
                <button type="submit" class="ml-3 inline-flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">Uložit článek</button>
            </div>
        </div>
    </form>
@endsection
