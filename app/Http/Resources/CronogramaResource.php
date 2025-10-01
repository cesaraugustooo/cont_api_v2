<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CronogramaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "dia"=>$this->dia,
            "alunos"=>$this->necessidadesHasCronogramas->map(function($aluno_has){
                return [
                    'id'=>$aluno_has->aluno_has_necessidade->aluno->id ?? null,
                    'nome'=>$aluno_has->aluno_has_necessidade->aluno->nome?? null,
                    'necessidade_relacionada'=>$aluno_has->aluno_has_necessidade->necessidade
                ];
            } ?? null)
        ];
    }
}
