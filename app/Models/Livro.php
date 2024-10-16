<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'editora', 'edicao', 'ano_publicacao', 'assunto_id', 'valor'];

    public function assunto()
    {
        return $this->belongsTo(Assunto::class, 'assunto_id');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autors', 'livro_id', 'autor_id');
    }
}
