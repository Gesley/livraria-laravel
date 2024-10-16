<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|string|max:100',
            'editora' => 'nullable|string|max:100',
            'edicao' => 'nullable|integer',
            'ano_publicacao' => 'required|integer|between:1500,' . date('Y'),
            'assunto_id' => 'required|exists:assuntos,id',
            'autores' => 'required|array',
            'autores.*' => 'exists:autors,id',
            'valor' => 'required|string',
        ];
    }
}
