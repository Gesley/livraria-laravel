@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Editar Autor</h1>


    <form action="{{ route('autores.update', $autor) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método PUT para atualização -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $autor->nome) }}" required>
            @error('nome')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>

</div>
@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif