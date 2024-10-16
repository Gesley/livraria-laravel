@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Relatório de Autores, Livros e Assuntos</h1>

    <!-- Botões para exportar -->
    <div class="mb-3">
        <a href="{{ route('relatorio.export') }}" class="btn btn-success">Exportar para Excel</a>
        <a href="{{ route('relatorio.exportPDF') }}" class="btn btn-danger">Exportar para PDF</a>
    </div>

    <!-- Formulário de pesquisa -->
    <form method="GET" action="{{ route('relatorio.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por autor, livro ou assunto" value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
        </div>
    </form>

    <!-- Relatório agrupado por autor -->
    @foreach ($relatorios as $autor)
        <div class="card mb-4 shadow-sm"> <!-- Adicionando sombra para destaque -->
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0"><b>Autor: </b> {{ $autor->nome }}</h3> <!-- Maior destaque no nome do autor -->
            </div>
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Título do Livro</th>
                            <th>Assunto</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($autor->livros as $livro)
                            <tr>
                                <td>{{ $livro->titulo }}</td>
                                <td>{{ $livro->assunto->descricao ?? 'Nenhum assunto associado' }}</td>
                                <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- Paginação -->
    <div class="d-flex justify-content-center mt-4">
        {{ $relatorios->links() }}
    </div>
</div>
@endsection
