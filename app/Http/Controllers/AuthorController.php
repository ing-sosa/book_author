<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return Inertia::render('Authors/Index', ['authors' => $authors]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Author::create($request->input());
        return redirect()->route('authors.index');
    }

    public function update(Request $request, Author $author)
    {
        $author->fill($request->post())->save();
        return redirect()->route('authors.index');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
