<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|max:100',
        ];
    }
}
