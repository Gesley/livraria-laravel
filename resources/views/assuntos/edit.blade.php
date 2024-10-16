@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Editar Assunto</h1>

    <form action="{{ route('assuntos.update', $assunto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" id="descricao" name="descricao" class="form-control" value="{{ old('descricao', $assunto->descricao) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
