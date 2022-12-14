<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuncionarioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "nome_do_funcionario" =>"required",
            "dataNascimento" =>"required",
            "telefone" =>"required",
            "email" => "required",
            "departamento" => "required",
            "empresa" => "required",
        ];
    }
}
