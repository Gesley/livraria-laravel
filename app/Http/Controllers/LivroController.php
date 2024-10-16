<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $livros = Livro::with('assunto') 
            ->when($search, function ($query, $search) {
                return $query->where('titulo', 'LIKE', "%{$search}%")
                             ->orWhere('editora', 'LIKE', "%{$search}%")
                             ->orWhere('ano_publicacao', is_numeric($search) ? $search : null) 
                             ->orWhereHas('assunto', function($q) use ($search) {
                                 $q->where('descricao', 'LIKE', "%{$search}%");
                             });
            })
            ->orderBy('id', 'asc')
            ->paginate(10);
    
        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.create', compact('autores', 'assuntos'));
    }

    public function store(StoreLivroRequest $request)
    {
        // Corrigindo formatação do valor monetário
        $valor = str_replace(',', '.', str_replace('.', '', $request->valor));

        $livro = Livro::create([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'ano_publicacao' => $request->ano_publicacao,
            'assunto_id' => $request->assunto_id,
            'valor' => $valor,
        ]);
    
        // Associando autores ao livro
        $livro->autores()->attach($request->autores);
    
        return redirect()->route('livros.index')->with('success', 'Livro adicionado com sucesso.');
    }

    public function edit($id)
    {
        $livro = Livro::with(['autores', 'assunto'])->findOrFail($id);
        $autores = Autor::all();
        $assuntos = Assunto::all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    public function update(UpdateLivroRequest $request, $id)
    {
        $livro = Livro::findOrFail($id);
    
        // Transformar o valor formatado antes de atualizar o banco
        $valor = str_replace(',', '.', str_replace('.', '', $request->valor));
    
        // Atualizando os dados do livro
        $livro->update([
            'titulo' => $request->titulo,
            'editora' => $request->editora,
            'edicao' => $request->edicao,
            'ano_publicacao' => $request->ano_publicacao,
            'valor' => $valor, // Certifique-se de que o valor está sendo atualizado corretamente
            'assunto_id' => $request->assunto_id,
        ]);
    
        // Atualizando os autores
        $livro->autores()->sync($request->autores);
    
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso.');
    }
    

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->autores()->detach();
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso.');
    }

    public function show($id)
    {
        $livro = Livro::with(['autores', 'assunto'])->findOrFail($id);
        return view('livros.show', compact('livro'));
    }
}
