<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssuntoRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Mudar para false se o usuário não tiver permissão
    }

    public function rules()
    {
        return [
            'descricao' => 'required|string|max:50',
        ];
    }
}
