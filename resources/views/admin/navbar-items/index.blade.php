@extends('layouts.app')

@section('title', 'Správa menu')

@section('content')
<div x-data="{ deleteModalOpen: false, deleteUrl: '' }">
    <header class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">Správa menu</h1>
                <p class="mt-2 text-lg text-gray-600">Upravujte položky v hlavní navigační liště.</p>
            </div>
            <a href="{{ route('admin.navbar-items.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 transition">Přidat položku</a>
        </div>
    </header>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-r-lg" role="alert">
            <p class="font-bold">Úspěch</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Název</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cesta (Route)</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pořadí</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Zarovnání</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Přístup</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Akce</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($navbarItems as $item)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->route }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->align == 'left' ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($item->align) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                             <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->requires_auth ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ $item->requires_auth ? 'Přihlášení' : 'Veřejný' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.navbar-items.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900">Editovat</a>
                            <button @click="deleteUrl = '{{ route('admin.navbar-items.destroy', $item) }}'; deleteModalOpen = true" class="text-red-600 hover:text-red-900 ml-4">Smazat</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">Nebyly nalezeny žádné položky menu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="deleteModalOpen" class="fixed z-10 inset-0 overflow-y-auto" style="display: none;" x-cloak><!-- Modal Code... --></div>
</div>
@endsection
