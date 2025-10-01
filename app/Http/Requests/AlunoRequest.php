<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
			'nome' => 'required|string',
			'genero' => 'required|string',
            'descricao'=>'nullable|string',
			'foto' => 'string',
			'turmas_id' => 'required|exists:turmas,id',
			'data_nascimento' => 'required|date',
			'rm' => 'required|string',
        ];
    }
}
