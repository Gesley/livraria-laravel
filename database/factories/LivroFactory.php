<?php

namespace Database\Factories;

use App\Models\Livro;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'editora' => $this->faker->company,
            'edicao' => $this->faker->numberBetween(1, 10),
            'ano_publicacao' => $this->faker->year,
            'valor' => $this->faker->randomFloat(2, 10, 1000),
            'assunto_id' => Assunto::factory(), // Relacionamento com Assunto
        ];
    }
}
