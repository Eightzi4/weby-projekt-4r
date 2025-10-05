<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

@if($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-r-lg">
        <p class="font-bold">Chyba při ukládání</p>
        <ul class="list-disc list-inside mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Název článku</label>
        <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>

    <div>
        <label for="date" class="block text-sm font-medium text-gray-700">Datum publikace</label>
        <input type="date" name="date" id="date" value="{{ old('date', isset($article) ? $article->date->format('Y-m-d') : now()->format('Y-m-d')) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
    </div>

    <div>
        <label for="photo" class="block text-sm font-medium text-gray-700">Hlavní obrázek</label>
        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        @if(isset($article) && $article->photo)
            <div class="mt-4">
                <p class="text-sm text-gray-500 mb-2">Aktuální obrázek:</p>
                <img src="{{ asset('storage/images/articles/' . $article->photo) }}" alt="Aktuální obrázek" class="h-32 rounded-md">
            </div>
        @endif
    </div>

    <div>
        <label for="text-editor" class="block text-sm font-medium text-gray-700">Text článku</label>
        <div class="mt-1">
            <textarea name="text" id="text-editor" rows="10">{{ old('text', $article->text ?? '') }}</textarea>
        </div>
    </div>

    <div class="space-y-4">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="published" name="published" type="checkbox" value="1" {{ old('published', $article->published ?? true) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-sm">
                <label for="published" class="font-medium text-gray-700">Publikováno</label>
                <p class="text-gray-500">Zveřejnit článek na webu.</p>
            </div>
        </div>
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="top" name="top" type="checkbox" value="1" {{ old('top', $article->top ?? false) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
            </div>
            <div class="ml-3 text-sm">
                <label for="top" class="font-medium text-gray-700">Top článek</label>
                <p class="text-gray-500">Zobrazit na hlavní stránce v dlaždicích.</p>
            </div>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create( document.querySelector( '#text-editor' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo' ]
        } )
        .catch( error => { console.error( error ); } );
</script>
