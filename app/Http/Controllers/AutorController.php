<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAutorRequest;

class AutorController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search');
        $autores = Autor::when($search, function ($query, $search) {
            return $query->where('nome', 'LIKE', "%{$search}%");
        })->orderBy('id', 'asc')->paginate(10);

        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(StoreAutorRequest $request)
    {
        Autor::create($request->all());
        return redirect()->route('autores.index')->with('success', 'Autor adicionado com sucesso.');
    }

    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.show', compact('autor'));
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(StoreAutorRequest $request, $id)
    {
        $autor = Autor::findOrFail($id);
        $autor->nome = $request->nome;
        $autor->save();

        return redirect()->route('autores.index')->with('success', 'Autor atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);
    
        if ($autor->livros()->count() > 0) {
            return redirect()->route('autores.index')->with('error', 'Não é possível excluir o autor porque ele possui livros associados.');
        }
    
        $autor->delete();
    
        return redirect()->route('autores.index')->with('success', 'Autor excluído com sucesso.');
    }
    
}
