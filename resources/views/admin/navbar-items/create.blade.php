@extends('layouts.app')
@section('title', 'Přidat položku menu')
@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Přidat novou položku menu</h1>
    <form action="{{ route('admin.navbar-items.store') }}" method="POST">
        @csrf
        <div class="bg-white shadow-md rounded-lg p-6">
            @include('admin.navbar-items._form')
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Uložit</button>
            </div>
        </div>
    </form>
@endsection
