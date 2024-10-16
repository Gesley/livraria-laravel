@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Adicionar Assunto</h1>

    <form action="{{ route('assuntos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" id="descricao" name="descricao" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar Assunto</button>
        <a href="{{ route('assuntos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
