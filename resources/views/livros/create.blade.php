@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Adicionar Livro</h1>

    <form action="{{ route('livros.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="editora" class="form-label">Editora</label>
            <input type="text" id="editora" name="editora" class="form-control">
        </div>

        <div class="mb-3">
            <label for="edicao" class="form-label">Edição</label>
            <input type="number" id="edicao" name="edicao" class="form-control">
        </div>

        <div class="mb-3">
            <label for="ano_publicacao" class="form-label">Ano de Publicação</label>
            <input type="number" id="ano_publicacao" name="ano_publicacao" class="form-control" required
                   min="1500" max="{{ date('Y') }}">
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="text" id="valor" name="valor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="assunto_id" class="form-label">Assunto</label>
            <select name="assunto_id" id="assunto_id" class="form-control" required>
                @foreach($assuntos as $assunto)
                    <option value="{{ $assunto->id }}">{{ $assunto->descricao }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="autores" class="form-label">Autores</label>
            <select name="autores[]" id="autores" class="form-control" multiple required>
                @foreach($autores as $autor)
                    <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Adicionar Livro</button>
        <a href="{{ route('livros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#valor').mask('000.000.000.000,00', {reverse: true});
    });
</script>
@endsection
