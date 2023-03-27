<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return Inertia::render('Books/Index', ['books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'year_published' => 'required', 'isbn' => 'required', 'author_id' => 'required']);
        Book::create($request->input());
        return redirect()->route('books.index');
    }

    public function update(Request $request, Book $book)
    {
        $book->fill($request->post())->save();
        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
