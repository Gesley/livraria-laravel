<?php

namespace App\Exports;

use App\Models\Autor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RelatorioExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Autor::with(['livros.assunto'])
            ->get()
            ->map(function ($autor) {
                return $autor->livros->map(function ($livro) use ($autor) {
                    return [
                        'autor' => $autor->nome,
                        'livro' => $livro->titulo,
                        'assunto' => $livro->assunto->descricao ?? 'Nenhum assunto associado',
                        'valor' => number_format($livro->valor, 2, ',', '.'),
                    ];
                });
            })->flatten(1); // Flatten para garantir que não haja problemas de estrutura
    }

    public function headings(): array
    {
        return [
            'Autor',
            'Livro',
            'Assunto',
            'Valor',
        ];
    }
}




