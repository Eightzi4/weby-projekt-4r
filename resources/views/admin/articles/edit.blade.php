@extends('layouts.app')

@section('title', 'Upravit článek')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Upravit článek</h1>
    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded-lg p-6">
            @include('admin.articles._form', ['article' => $article])
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Uložit změny</button>
            </div>
        </div>
    </form>
@endsection
