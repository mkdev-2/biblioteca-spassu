<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Titulo' => 'required|string|max:40',
            'Editora' => 'required|string|max:40',
            'Edicao' => 'required|integer|min:1',
            'AnoPublicacao' => 'required|digits:4',
            'Valor' => 'required|numeric|min:0|max:9999999.99',
            'autores' => 'required|array|min:1',
            'autores.*' => 'exists:autores,CodAu',
            'assuntos' => 'required|array|min:1',
            'assuntos.*' => 'exists:assuntos,CodAs'
        ];
    }
}
