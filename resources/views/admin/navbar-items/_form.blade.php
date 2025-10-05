@if($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-r-lg">
        <p class="font-bold">Chyba při ukládání</p>
        <ul class="list-disc list-inside mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Název</label>
        <input type="text" name="title" id="title" value="{{ old('title', $navbarItem->title ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>
    <div>
        <label for="route" class="block text-sm font-medium text-gray-700">Cesta (název routy)</label>
        <input type="text" name="route" id="route" value="{{ old('route', $navbarItem->route ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
        <p class="mt-2 text-xs text-gray-500">Např. 'home', 'seasons.index', 'admin.articles.index'</p>
    </div>
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Pořadí</label>
        <input type="number" name="order" id="order" value="{{ old('order', $navbarItem->order ?? '0') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>
    <div>
        <label for="align" class="block text-sm font-medium text-gray-700">Zarovnání</label>
        <select name="align" id="align" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <option value="left" {{ old('align', $navbarItem->align ?? 'left') == 'left' ? 'selected' : '' }}>Vlevo</option>
            <option value="right" {{ old('align', $navbarItem->align ?? 'left') == 'right' ? 'selected' : '' }}>Vpravo</option>
        </select>
    </div>
    <div class="relative flex items-start">
        <div class="flex items-center h-5">
            <input id="requires_auth" name="requires_auth" type="checkbox" value="1" {{ old('requires_auth', $navbarItem->requires_auth ?? false) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
        </div>
        <div class="ml-3 text-sm">
            <label for="requires_auth" class="font-medium text-gray-700">Vyžaduje přihlášení?</label>
            <p class="text-gray-500">Položka bude viditelná pouze pro přihlášené administrátory.</p>
        </div>
    </div>
</div>
