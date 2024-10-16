<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRelatorioAutoresLivrosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW relatorio_autores_livros AS
            SELECT a.nome AS autor,
                   l.titulo AS livro,
                   s.descricao AS assunto,
                   l.valor
            FROM autors a
            JOIN livro_autors la ON la.autor_id = a.id
            JOIN livros l ON la.livro_id = l.id
            JOIN assuntos s ON l.assunto_id = s.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS relatorio_autores_livros');
    }
}
