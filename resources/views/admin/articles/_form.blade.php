{{-- ======================================================== --}}
{{-- ==== ZDE ZAČÍNÁ NOVÝ KÓD PRO CKEDITOR 5 ==== --}}
{{-- ======================================================== --}}

{{-- 1. Načteme CKEditor 5 z CDN (nevyžaduje API klíč) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

{{-- ======================================================== --}}
{{-- ================ KONEC NOVÉHO KÓDU ==================== --}}
{{-- ======================================================== --}}


@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-3 gap-6">
    <div class="col-span-3">
        <label for="title" class="block text-sm font-medium text-gray-700">Název článku</label>
        <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div class="col-span-3">
        <label for="date" class="block text-sm font-medium text-gray-700">Datum publikace</label>
        <input type="date" name="date" id="date"
            value="{{ old('date', isset($article) ? $article->date->format('Y-m-d') : '') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>

    <div class="col-span-3">
        <label class="block text-sm font-medium text-gray-700">Hlavní obrázek</label>
        <input type="file" name="photo"
            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
        @if (isset($article) && $article->photo)
            <img src="{{ asset('storage/images/articles/' . $article->photo) }}" alt="Current Photo" class="mt-2 h-32">
        @endif
    </div>

    <div class="col-span-3">
        <label for="text-editor" class="block text-sm font-medium text-gray-700">Text článku</label>
        {{-- Naše textarea zůstává stejná, jen má ID, na které se naváže editor --}}
        <textarea name="text" id="text-editor" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('text', $article->text ?? '') }}</textarea>
    </div>

    <div class="col-span-3 flex items-center space-x-8">
        <div class="flex items-start">
            <input id="published" name="published" type="checkbox" value="1"
                {{ old('published', $article->published ?? false) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-indigo-600">
            <label for="published" class="ml-2 block text-sm text-gray-900">Publikováno</label>
        </div>
        <div class="flex items-start">
            <input id="top" name="top" type="checkbox" value="1"
                {{ old('top', $article->top ?? false) ? 'checked' : '' }}
                class="h-4 w-4 rounded border-gray-300 text-indigo-600">
            <label for="top" class="ml-2 block text-sm text-gray-900">Top článek</label>
        </div>
    </div>
</div>

{{-- ======================================================== --}}
{{-- ==== ZDE ZAČÍNÁ NOVÝ KÓD PRO INICIALIZACI ==== --}}
{{-- ======================================================== --}}
<script>
    // 2. Najdeme textareu podle jejího ID a spustíme na ní CKEditor
    ClassicEditor
        .create(document.querySelector('#text-editor'), {
            // Zde můžeme přidat další konfiguraci, pokud bude potřeba
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent',
                'indent', '|', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>
{{-- ======================================================== --}}
{{-- ================ KONEC NOVÉHO KÓDU ==================== --}}
{{-- ======================================================== --}}
