<footer class="bg-dark text-white text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase">Livraria Laravel</h5>
                <p>
                    Um projeto Laravel simples para gerenciar livros, autores e assuntos.
                </p>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="{{ route('livros.index') }}" class="text-white">Livros</a>
                    </li>
                    <li>
                        <a href="{{ route('autores.index') }}" class="text-white">Autores</a>
                    </li>
                    <li>
                        <a href="{{ route('assuntos.index') }}" class="text-white">Assuntos</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Contato</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="mailto:contato@livraria-laravel.com" class="text-white">contato@livraria-laravel.com</a>
                    </li>
                    <li>
                        <a href="#" class="text-white">Sobre nós</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-center p-3 bg-secondary">
        © {{ date('Y') }} Livraria Laravel. Todos os direitos reservados.
    </div>
</footer>
