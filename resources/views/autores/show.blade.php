@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Detalhes do Autor</h1>

        <div class="card">
            <div class="card-header">
                Autor: {{ $autor->nome }}
            </div>
            <div class="card-body">
                <h5 class="card-title">ID: {{ $autor->id }}</h5>
                <p class="card-text">Nome: {{ $autor->nome }}</p>

                <a href="{{ route('autores.edit', $autor) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('autores.destroy', $autor) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
                <a href="{{ route('autores.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection
