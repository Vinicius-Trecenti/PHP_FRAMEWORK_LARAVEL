<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //Regras que o request deve ter
            'nome' => ['required','min:3']
        ];
    }

    public function messages(): array{
        return [
            //nome.* pega uma mensagem para todos os erros
            'nome.required'=> 'O campo nome é obrigatorio',
            'nome.min'=> 'O campo nome precisa de :min caracteres'
        ];
    }
}
