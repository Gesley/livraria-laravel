@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Top 10 Autores com Mais Livros</h1>

    <!-- Gráfico de Barras Horizontal -->
    <canvas id="livrosChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('livrosChart').getContext('2d');

            // Preparando os dados para o gráfico
            const labels = @json($autores); // Nomes dos autores
            const data = @json($quantidadeLivros); // Quantidade de livros

            // Criando o gráfico de barras horizontal
            const livrosChart = new Chart(ctx, {
                type: 'bar', // Tipo do gráfico
                data: {
                    labels: labels, // Rótulos (autores)
                    datasets: [{
                        label: 'Quantidade de Livros por Autor',
                        data: data, // Dados (quantidade de livros)
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor das barras
                        borderColor: 'rgba(75, 192, 192, 1)', // Cor da borda das barras
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Define a orientação horizontal
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true // Começa o eixo X em zero
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Distribuição de Livros por Autor (Top 10)'
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection
