<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavbarItem;
use Illuminate\Http\Request;

class NavbarItemController extends Controller
{
    public function index()
    {
        $navbarItems = NavbarItem::orderBy('order')->get();
        return view('admin.navbar-items.index', compact('navbarItems'));
    }

    public function create()
    {
        return view('admin.navbar-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
            'align' => 'required|in:left,right',
        ]);

        NavbarItem::create([
            'title' => $validated['title'],
            'route' => $validated['route'],
            'order' => $validated['order'],
            'align' => $validated['align'],
            'requires_auth' => $request->has('requires_auth'),
            'is_admin_item' => $request->has('requires_auth'), // Logiku pro admin položky navážeme na 'requires_auth'
        ]);

        return redirect()->route('admin.navbar-items.index')->with('success', 'Položka menu byla úspěšně vytvořena.');
    }

    public function edit(NavbarItem $navbarItem)
    {
        return view('admin.navbar-items.edit', compact('navbarItem'));
    }

    public function update(Request $request, NavbarItem $navbarItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'order' => 'required|integer',
            'align' => 'required|in:left,right',
        ]);

        $navbarItem->update([
            'title' => $validated['title'],
            'route' => $validated['route'],
            'order' => $validated['order'],
            'align' => $validated['align'],
            'requires_auth' => $request->has('requires_auth'),
            'is_admin_item' => $request->has('requires_auth'),
        ]);

        return redirect()->route('admin.navbar-items.index')->with('success', 'Položka menu byla úspěšně upravena.');
    }

    public function destroy(NavbarItem $navbarItem)
    {
        $navbarItem->delete();
        return redirect()->route('admin.navbar-items.index')->with('success', 'Položka menu byla úspěšně smazána.');
    }
}
