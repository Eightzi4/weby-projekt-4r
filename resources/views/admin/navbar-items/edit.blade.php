@extends('layouts.app')
@section('title', 'Upravit položku menu')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Upravit položku menu</h1>
    <form action="{{ route('admin.navbar-items.update', $navbarItem) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white shadow-md rounded-lg p-6">
            @include('admin.navbar-items._form', ['navbarItem' => $navbarItem])
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Uložit změny</button>
            </div>
        </div>
    </form>
@endsection
