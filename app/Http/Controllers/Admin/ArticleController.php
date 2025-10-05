<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('date', 'desc')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'required|date',
        ]);

        $path = $request->file('photo')->store('images/articles', 'public');

        Article::create([
            'title' => $validated['title'],
            'text' => $validated['text'],
            'photo' => basename($path),
            'date' => $validated['date'],
            'link' => Str::slug($validated['title']),
            'published' => $request->has('published'),
            'top' => $request->has('top'),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Článek byl úspěšně vytvořen.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'date' => 'required|date',
        ]);

        $data = [
            'title' => $validated['title'],
            'text' => $validated['text'],
            'date' => $validated['date'],
            'link' => Str::slug($validated['title']),
            'published' => $request->has('published'),
            'top' => $request->has('top'),
        ];

        if ($request->hasFile('photo')) {
            if ($article->photo) {
                Storage::disk('public')->delete('images/articles/' . $article->photo);
            }
            $path = $request->file('photo')->store('images/articles', 'public');
            $data['photo'] = basename($path);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Článek byl úspěšně upraven.');
    }

    public function destroy(Article $article)
    {
        if ($article->photo) {
            Storage::disk('public')->delete('images/articles/' . $article->photo);
        }
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Článek byl úspěšně smazán.');
    }
}
