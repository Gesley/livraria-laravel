@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Criar Autor</h1>

        <form action="{{ route('autores.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" required>
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
