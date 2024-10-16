@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Livros</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('livros.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por título, editora, ano ou assunto" value="{{ request()->get('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
        </div>
    </form>

    <a href="{{ route('livros.create') }}" class="btn btn-primary mb-3">Adicionar Livro</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Ano de Publicação</th>
                <th>Assunto</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
            <tr>
                <td>{{ $livro->id }}</td>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->edicao }}</td>
                <td>{{ $livro->ano_publicacao }}</td>
                <td>{{ $livro->assunto->descricao ?? 'Nenhum' }}</td>
                <td>R$ {{ number_format($livro->valor, 2, ',', '.') }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Ações">
                        <a href="{{ route('livros.show', $livro) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('livros.edit', $livro) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('livros.destroy', $livro) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Centralizar e estilizar a paginação -->
    <div class="d-flex justify-content-center mt-4">
        {{ $livros->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
