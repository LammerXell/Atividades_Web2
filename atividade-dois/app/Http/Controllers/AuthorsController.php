<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Mostra uma lista de Autores.
     */
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:authors|max:255', 
        ], [
            'name.required' => 'O nome do autor é obrigatório.', 
            'name.string' => 'O nome do autor deve ser um texto.',
            // ... (Mensagens de outras regras de validação)
        ]);
        $author = new Author;
        $author ->name = $request->name;
        $author ->save();
        return view('authors.index')->with('success', 'Autor criado com sucesso.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::find($id);

        $request->validate([
            'name' => 'required|string|unique:authors,name,' . $author->id . '|max:255',
        ]);
        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor excluído com sucesso.');
    }
}
