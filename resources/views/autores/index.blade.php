@extends('layouts.app')

@section('content') <!-- Definindo a seção 'content' -->
    <div class="container mt-4">
        <h1 class="mb-4">Lista de Autores</h1>

        <!-- Exibir mensagens de sucesso -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Exibir mensagens de erro -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" action="{{ route('autores.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar por nome" value="{{ request()->get('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
            </div>
        </form>

        <a href="{{ route('autores.create') }}" class="btn btn-primary mb-3">Adicionar Autor</a>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('autores.destroy', $autor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Certifique-se de que este método esteja definido -->
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Links de paginação -->
        {{ $autores->links() }} <!-- Adicionando a paginação aqui -->
    </div>
@endsection
