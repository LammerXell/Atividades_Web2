<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|string|unique:publishers|max:255'], [
            'name.required' => 'O nome do editora é obrigatório.',
            'name.string' => 'O nome da editora deve ser um texto.',
        ]);
        Publisher::create($request->all());
        return redirect()->route('publishers.index')->with('success', 'Editora criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('publishers.edit', compact ('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate(['name'=>'required|string|unique:publishers|max:255'], [
            'name.required' => 'O nome da editora é obrigatório.',
            'name.string' => 'O nome da editora deve ser um texto.',
        ]);
        
        $publisher->update($request->all());
        return redirect()->route('publishers.index')->with('success', 'Editora atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success', 'Editora excluída com sucesso.');
    }
}
