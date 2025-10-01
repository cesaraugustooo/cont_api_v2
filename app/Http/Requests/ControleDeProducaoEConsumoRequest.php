<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ControleDeProducaoEConsumoRequest extends FormRequest
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
			'nome_alimento' => 'required|string',
			'data_alimento' => 'required|date',
			'quantidade_alimento' => 'required|numeric',
			'medida_alimento' => 'required|string',
			'pessoas_alimento' => 'required|int',
			'sobra_limpa_alimento' => 'required|numeric',
			'desperdicio_alimento' => 'required|numeric',
        ];
    }
}
