<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LivroTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function um_livro_pode_ser_criado_com_campos_validos()
    {
        // Criando um assunto e um autor como dependências
        $assunto = Assunto::factory()->create();
        $autores = Autor::factory(2)->create(); // Dois autores

        // Criando um livro
        $livro = Livro::create([
            'titulo' => 'Teste de Livro',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2023,
            'valor' => 99.99,
            'assunto_id' => $assunto->id
        ]);

        // Associando autores ao livro
        $livro->autores()->attach($autores->pluck('id'));

        // Verificações
        $this->assertDatabaseHas('livros', ['titulo' => 'Teste de Livro']);
        $this->assertEquals(2, $livro->autores->count());
        $this->assertEquals($assunto->id, $livro->assunto->id);
    }

    /** @test */
public function test_livro_deve_ter_um_assunto_valido()
{
    $this->expectException(\Illuminate\Database\QueryException::class);

    // Tente criar um livro com um assunto_id inválido
    Livro::create([
        'titulo' => 'Livro Teste',
        'editora' => 'Editora Teste',
        'edicao' => 1,
        'ano_publicacao' => 2024,
        'assunto_id' => 999999, 
    ]);
}

    /** @test */
    public function o_valor_do_livro_deve_ser_um_decimal_valido()
    {
        // Criando um assunto e autores
        $assunto = Assunto::factory()->create();
        $autores = Autor::factory(2)->create();

        // Criando um livro com um valor decimal
        $livro = Livro::create([
            'titulo' => 'Teste de Valor',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2023,
            'valor' => 150.75,
            'assunto_id' => $assunto->id
        ]);

        $livro->autores()->attach($autores->pluck('id'));

        $this->assertEquals(150.75, $livro->valor);
        $this->assertDatabaseHas('livros', ['titulo' => 'Teste de Valor']);
    }

    /** @test */
    public function um_livro_nao_deve_ter_um_valor_acima_do_permitido()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Livro::create([
            'titulo' => 'Valor acima do permitido',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'ano_publicacao' => 2023,
            'valor' => 4679874654987700.75, // Valor muito alto
            'assunto_id' => Assunto::factory()->create()->id
        ]);
    }
}
