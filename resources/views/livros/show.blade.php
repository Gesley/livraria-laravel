@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalhes do Livro</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $livro->titulo }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">Informações do Livro</h6>
            <p><strong>Editora:</strong> {{ $livro->editora }}</p>
            <p><strong>Edição:</strong> {{ $livro->edicao }}</p>
            <p><strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($livro->valor, 2, ',', '.') }}</p> 
            <p><strong>Assunto:</strong> {{ $livro->assunto->descricao ?? 'Nenhum assunto associado' }}</p>
            
            <p><strong>Autores: </strong></p>
            <ul class="list-group mb-3">
                @foreach ($livro->autores as $autor)
                    <li class="list-group-item">{{ $autor->nome }}</li>
                @endforeach
            </ul>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
