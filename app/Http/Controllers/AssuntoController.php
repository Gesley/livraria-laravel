<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssuntoRequest;

class AssuntoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $assuntos = Assunto::when($search, function ($query, $search) {
            return $query->where('descricao', 'LIKE', "%{$search}%");
        })
        ->orderBy('id', 'asc')
        ->paginate(10);

        return view('assuntos.index', compact('assuntos'));
    }

    public function create()
    {
        return view('assuntos.create');
    }

    public function store(StoreAssuntoRequest $request)
    {
        Assunto::create($request->validated());
        return redirect()->route('assuntos.index')->with('success', 'Assunto adicionado com sucesso.');
    }

    public function edit($id)
    {
        $assunto = Assunto::findOrFail($id);
        return view('assuntos.edit', compact('assunto'));
    }

    public function update(StoreAssuntoRequest $request, $id)
    {
        $assunto = Assunto::findOrFail($id);
        $assunto->update($request->validated());
        return redirect()->route('assuntos.index')->with('success', 'Assunto atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $assunto = Assunto::findOrFail($id);
    
        if ($assunto->livros()->exists()) {
            return redirect()->route('assuntos.index')->with('error', 'Não é possível excluir este assunto porque ele está associado a um ou mais livros.');
        }

        $assunto->delete();
    
        return redirect()->route('assuntos.index')->with('success', 'Assunto excluído com sucesso.');
    }
    
}

