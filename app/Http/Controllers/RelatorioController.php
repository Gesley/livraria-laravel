<?php

namespace App\Http\Controllers;

use App\Models\RelatorioView; 
use App\Models\Autor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\RelatorioExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Trazendo os autores com os livros e os assuntos já agrupados
        $relatorios = Autor::with(['livros.assunto'])
            ->when($search, function ($query) use ($search) {
                return $query->where('nome', 'like', "%{$search}%")
                    ->orWhereHas('livros', function ($q) use ($search) {
                        $q->where('titulo', 'like', "%{$search}%")
                            ->orWhereHas('assunto', function ($q) use ($search) {
                                $q->where('descricao', 'like', "%{$search}%");
                            });
                    });
            })
            ->paginate(10);
    
        return view('relatorio.index', compact('relatorios'));
    }
    

    public function exportPDF()
    {
        $relatorios = RelatorioView::all();

        if ($relatorios->isEmpty()) {
            return response()->json(['message' => 'Nenhum autor encontrado'], 404);
        }

        $pdf = PDF::loadView('relatorio.pdf', compact('relatorios'));

        return $pdf->download('relatorio_livros.pdf');
    }

    public function graficos()
    {
        $relatorios = RelatorioView::all();
        $dadosAutores = [];
    
        foreach ($relatorios as $relatorio) {
            if (!isset($dadosAutores[$relatorio->autor])) {
                $dadosAutores[$relatorio->autor] = 0;
            }
            $dadosAutores[$relatorio->autor]++;
        }
    
        // Transformar em arrays para serem usados no gráfico
        $autores = array_keys($dadosAutores); // Lista de autores
        $quantidadeLivros = array_values($dadosAutores); // Quantidade de livros por autor
    
        return view('relatorio.graficos', compact('autores', 'quantidadeLivros'));
    }
    

    public function export()
    {
        return Excel::download(new RelatorioExport, 'relatorio_livros.xlsx');
    }
}

