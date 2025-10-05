@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="grid grid-cols-1 gap-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Název</label>
        <input type="text" name="title" id="title" value="{{ old('title', $navbarItem->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
    <div>
        <label for="route" class="block text-sm font-medium text-gray-700">Cesta (název routy)</label>
        <input type="text" name="route" id="route" value="{{ old('route', $navbarItem->route ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700">Pořadí</label>
        <input type="number" name="order" id="order" value="{{ old('order', $navbarItem->order ?? '0') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
    <div class="flex items-start">
        <input id="is_admin_item" name="is_admin_item" type="checkbox" value="1" {{ old('is_admin_item', $navbarItem->is_admin_item ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-indigo-600">
        <label for="is_admin_item" class="ml-2 block text-sm text-gray-900">Je položka pouze pro administraci?</label>
    </div>
</div>
