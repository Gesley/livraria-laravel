<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Livros</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Relatório de Livros</h1>
    <table>
        <thead>
            <tr>
                <th>Autor</th>
                <th>Livros</th>
                <th>Assuntos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($autores as $autor)
                <tr>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        @foreach($autor->livros as $livro)
                            {{ $livro->titulo }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($autor->livros as $livro)
                            @if($livro->assunto)
                                {{ $livro->assunto->descricao }}<br>
                            @else
                                Nenhum assunto associado<br>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
