@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Assuntos</h1>

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

    <form method="GET" action="{{ route('assuntos.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Pesquisar por descrição" value="{{ request()->get('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
        </div>
    </form>

    <a href="{{ route('assuntos.create') }}" class="btn btn-primary mb-3">Adicionar Assunto</a>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assuntos as $assunto)
            <tr>
                <td>{{ $assunto->id }}</td>
                <td>{{ $assunto->descricao }}</td>
                <td>
                    <a href="{{ route('assuntos.edit', $assunto) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('assuntos.destroy', $assunto) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Links de paginação -->
    {{ $assuntos->links() }}
</div>
@endsection
