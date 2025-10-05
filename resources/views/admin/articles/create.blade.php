@extends('layouts.app')

@section('title', 'Přidat nový článek')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Přidat nový článek</h1>
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white shadow-md rounded-lg p-6">
            @include('admin.articles._form')
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Uložit článek</button>
            </div>
        </div>
    </form>
@endsection
